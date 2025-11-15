class ApiConfig {
  static const String baseUrl = String.fromEnvironment(
    'API_URL', defaultValue: 'http://api.localhost:8080/api'
  );
}