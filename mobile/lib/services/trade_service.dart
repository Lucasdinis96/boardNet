import 'package:dio/dio.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../config/api_config.dart';
import '../models/trade_model.dart';

class TradeService {
  static final Dio _dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      connectTimeout: const Duration(seconds: 10),
      receiveTimeout: const Duration(seconds: 10),
    ),
  );

  static Future<List<Trade>> fetchTrades() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token');
    try {
      final response = await _dio.get(
        '/trades',
        options: Options(
          headers: {'Authorization': 'Bearer $token'},
        ),
      );

      final tradesList = response.data['data'] as List;
      
      return tradesList.map((json) => Trade.fromJson(json)).toList();
    } catch (e) {
      throw Exception('Erro ao carregar trades: $e');
    }
  }

  /// Buscar uma trade específica
  static Future<Trade> fetchTradeById(String token, int id) async {
    try {
      final response = await _dio.get(
        '/trade/$id',
        options: Options(
          headers: {'Authorization': 'Bearer $token'},
        ),
      );

      final json = response.data['data'];

      return Trade.fromJson(json);
    } catch (e) {
      throw Exception('Erro ao carregar trade $id: $e');
    }
  }
}
