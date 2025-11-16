import 'package:dio/dio.dart';
import '../config/api_config.dart';
import 'package:shared_preferences/shared_preferences.dart';

class CityService {
  final Dio _dio = Dio(BaseOptions(baseUrl: ApiConfig.baseUrl));

  Future<Map<int, Map<String, dynamic>>> getCities() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token');

    final response = await _dio.get(
      '/cities',
      options: Options(headers: {'Authorization': 'Bearer $token'}),
    );

    final cidades = <int, Map<String, dynamic>>{};
    for (var cidade in response.data) {
      cidades[cidade['id']] = {
        'nome': cidade['name'],
      };
    }

    return cidades;
  }
}
