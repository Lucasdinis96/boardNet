import 'package:flutter/material.dart';
import 'package:mobile/widgets/appbar.dart';
import '../services/trade_service.dart';
import '../models/trade_model.dart';
import '../services/city_service.dart';
import 'package:url_launcher/url_launcher.dart';

class TradesPage extends StatefulWidget {
  
  final String token;
  const TradesPage({super.key, required this.token});

  @override
  State<TradesPage> createState() => _TradesPageState();
}

class _TradesPageState extends State<TradesPage> {
  late Future<List<Trade>> tradesFuture;
  final _cityService = CityService();
  Map<int, Map<String, dynamic>> _cidades = {};
  bool _loadingCidades = true;

  

  @override
  void initState() {
    super.initState();
    _loadCitiesAndTrades();
  }

  Future<void> _loadCitiesAndTrades() async {
    // Busca cidades e trades em paralelo
    final trades = TradeService.fetchTrades(widget.token);
    final cidades = await _cityService.getCidades();

    setState(() {
      _cidades = cidades;
      _loadingCidades = false;
      tradesFuture = trades;
    });
  }

  @override
  Widget build(BuildContext context) {
    if (_loadingCidades) {
      return const Scaffold(
        body: Center(child: CircularProgressIndicator()),
      );
    }

    return Scaffold(
      appBar: CustomAppBar(titleText: 'Anúncios'),
      body: FutureBuilder<List<Trade>>(
        future: tradesFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          }
          if (snapshot.hasError) {
            return Center(
              child: Text('Erro: ${snapshot.error}'),
            );
          }

          final trades = snapshot.data ?? [];

          if (trades.isEmpty) {
            return const Center(child: Text('Nenhum trade encontrado.'));
          }

          return ListView.builder(
            itemCount: trades.length,
            itemBuilder: (context, index) {
              final trade = trades[index];
              final user = trade.user;
              final cidade = _cidades[user.cityId];
              final cidadeNome = cidade?['name'] ?? 'Cidade não encontrada';
              return Card(
                color: Color(0xFFC9A14D),
                margin: const EdgeInsets.all(12),
                child: Padding(
                  padding: const EdgeInsets.all(8),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(trade.title,
                          style: const TextStyle(
                              fontSize: 18, fontWeight: FontWeight.bold)),
                      if (trade.description != null)
                        Text(trade.description!),
                      const SizedBox(height: 6),
                      Text('Usuário: ${trade.user.name}'),
                      Text('Cidade: $cidadeNome'),
                      const SizedBox(height: 6),
                      Text('Jogos:'),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: trade.boardgames.map((boardgame) {
                          return Row(
                            children: [
                              const SizedBox(width: 10),
                              Expanded(
                                child: Text('${boardgame.title} - R\$${boardgame.value} - ${boardgame.playtime}'),
                              ),
                            ],
                          );
                        }).toList(),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          ElevatedButton.icon(
                            onPressed: () {
                              final phone = trade.user.phone;
                              final whatsappUrl = Uri.parse('https://wa.me/$phone');
                              launchUrl(whatsappUrl, mode: LaunchMode.externalApplication);
                            },
                            label: const Text('Conversar no WhatsApp', style: TextStyle(color: Colors.white),),
                            style: ElevatedButton.styleFrom(
                              backgroundColor: Colors.green[600],
                              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(8),
                              ),
                            ),
                          ),
                          const SizedBox(width: 10),
                          ElevatedButton(
                            onPressed: () {
                              Navigator.pushNamed(
                                context,
                                '/trade',
                                arguments: {
                                  'token': widget.token,
                                  'tradeId': trade.id,
                                },
                              );
                            },
                            child: const Text("Ver detalhes"),
                          ),
                        ]
                      ),
                    ],
                  ),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
