import 'dart:convert';
import 'package:http/http.dart' as http;
import '../config/api_config.dart';
import '../models/trade_model.dart';

class TradeService {
  static Future<List<Trade>> fetchTrades(String token) async {
    final url = Uri.parse('${ApiConfig.baseUrl}/trades');

    final response = await http.get(
      url,
      headers: {'Authorization': 'Bearer $token'},
    );

    if (response.statusCode == 200) {
      final body = json.decode(response.body);
      final tradesList = body['data'] as List;
      return tradesList.map((t) => Trade.fromJson(t)).toList();
    } else {
      throw Exception('Erro ao carregar trades (${response.statusCode})');
    }
  }

//   static Future<Trade> fetchTradeById(String token, int id) async {
//   final response = await dio.get(
//     '/trades/$id',
//     options: Options(headers: {'Authorization': 'Bearer $token'}),
//   );

//   return Trade.fromJson(response.data['trade']);
// }
}
