import 'package:dio/dio.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../config/api_config.dart';

class AuthService {
  final Dio _dio = Dio(BaseOptions(
    baseUrl: ApiConfig.baseUrl,
    headers: {'Accept': 'application/json'},
  ));

  Future<String?> login(String email, String password) async {
  try {
    final response = await _dio.post('/login', data: {
      'email': email,
      'password': password,
    });

    final token = response.data['token'];

    if (token == null || token.isEmpty) {
      return null;
    }

    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('token', token);

    _dio.options.headers['Authorization'] = 'Bearer $token';

    return token;
  } on DioException catch (e) {
      print('Erro no login: ${e.response?.data}');
    return null;
  }
}

  Future<void> logout() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token');
    if (token == null) return;

    try {
      await _dio.post(
        '/logout',
        options: Options(headers: {'Authorization': 'Bearer $token'}),
      );
    } catch (e) {
      print('Erro ao deslogar: $e');
    } finally {
      await prefs.remove('token');
    }
  }

  Future<String?> getToken() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('token');
  }

  Future<Map<String, dynamic>> register({
    required String name,
    required String email,
    required String password,
    required String confirmPassword,
    required String phone,
  }) async {
    try {
      final response = await _dio.post(
        '/register',
        data: {
          'name': name,
          'email': email,
          'password': password,
          'password_confirmation': confirmPassword,
          'phone': phone,
        },
      );

      return {
        'success': true,
        'data': response.data,
      };
    } catch (e) {
      return {
        'success': false,
        'error': e.toString(),
      };
    }
  }

  Future<Map<String, dynamic>> getProfile() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final token = prefs.getString('token');

      final response = await _dio.get(
        '/profile',
        options: Options(headers: {
          'Authorization': 'Bearer $token',
        }),
      );

      return {
        'success': true,
        'data': response.data,
      };
    } catch (e) {
      return {
        'success': false,
        'error': e.toString(),
      };
    }
  }


  Future<Map<String, dynamic>> editRegister({
    required String? name,
    required String? email,
    required String? phone,
  }) async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final token = prefs.getString('token');

      final response = await _dio.put(
        '/profile/update',
        data: {
          'name': name,
          'email': email,
          'phone': phone,
        },
        options: Options(
          headers: {'Authorization': 'Bearer $token'}
        )
      );

      return {
        'success': true,
        'data': response.data,
      };
    } catch (e) {
      return {
        'success': false,
        'error': e.toString(),
      };
    }
  }
}

