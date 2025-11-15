import 'package:mobile/widgets/appbar.dart';
import 'package:flutter/material.dart';
import 'package:mobile/models/trade_model.dart';
import 'package:url_launcher/url_launcher.dart';

class TradeDetailPage extends StatelessWidget {
  final Trade trade;

  const TradeDetailPage({super.key, required this.trade});

  @override
  Widget build(BuildContext context) {
    final user = trade.user;

    return Scaffold(
      appBar: CustomAppBar(titleText: trade.title),
      body: Container (
        width: double.infinity,
        padding: const EdgeInsets.all(16.0),
        child: Card(
          color: Color(0xFFC9A14D),
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisSize: MainAxisSize.min,
              children: [
                if (trade.description != null) 
                  Text(trade.description!),

                const SizedBox(height: 12),

                Text("Usuário: ${user.name}"),
                
                const SizedBox(height: 12),

                Text("Jogos:"),
                SizedBox(height: 4),
                ...trade.boardgames.map((boardgame) => Text(
                  "• ${boardgame.title} - R\$${boardgame.value}\n   - Jogadores: ${boardgame.players}\n   - Tempo de jogo: ${boardgame.playtime}\n    - Faixa etária: ${boardgame.ageRange}",
                )),

                const SizedBox(height: 12),
                
                ElevatedButton.icon(
                  onPressed: () {
                    final uri = Uri.parse("https://wa.me/${user.phone}");
                    launchUrl(uri, mode: LaunchMode.externalApplication);
                  },
                  label: const Text('Conversar no WhatsApp', style: TextStyle(color: Colors.white)),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green[600],
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8),
                    ),
                  ),
                )
              ],
            ),
          ),
        ),
      ),
    );
  }
}
