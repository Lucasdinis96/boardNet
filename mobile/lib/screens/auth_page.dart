import 'package:flutter/material.dart';
import '../services/auth_service.dart';
import '../app_routes.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});
  
  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _authService = AuthService();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  bool _isLoading = false;

  Future<void> _login() async {
  final token = await _authService.login(
    _emailController.text.trim(),
    _passwordController.text.trim(),
  );

  if (token != null && mounted) {
    Navigator.pushReplacementNamed(
      context,
      AppRoutes.trade,
      arguments: token,
    );
  } else {
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(content: Text('Falha no login. Verifique suas credenciais.')),
    );
  }
}

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('BoardNet', style: TextStyle(color: Color(0xFFC9A14D))), backgroundColor: Colors.black, centerTitle: true),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Image.asset('assets/images/icon.png', width: 150, height: 150),
            const SizedBox(height: 12),
            TextField(
              controller: _emailController,
              decoration: const InputDecoration(labelText: 'Email', filled: true, fillColor: Color(0xFFC9A14D)),
              keyboardType: TextInputType.emailAddress,
            ),
            const SizedBox(height: 12),
            TextField(
              controller: _passwordController,
              decoration: const InputDecoration(labelText: 'Senha', filled: true, fillColor: Color(0xFFC9A14D)),
              obscureText: true,
            ),
            const SizedBox(height: 20),
            _isLoading
                ? const Center(child: CircularProgressIndicator())
                : ElevatedButton(
                    onPressed: _login,
                    style: ElevatedButton.styleFrom(backgroundColor: Color(0xFFC9A14D)),
                    child: const Text('Entrar', style: TextStyle(color: Colors.black)),
                  ),
            const SizedBox(height: 20),
            ElevatedButton(
              onPressed: () {Navigator.of(context).pushNamed(AppRoutes.register);},
              style: ElevatedButton.styleFrom(backgroundColor: Color(0xFFC9A14D)),
              child: const Text('Criar conta', style: TextStyle(color: Colors.black)),
            )
          ],
        ),
      ),
    );
  }
}
