import 'package:flutter/material.dart';
import 'package:mobile/widgets/appbar.dart';
import '../services/auth_service.dart';

class EditRegisterPage extends StatefulWidget {
  const EditRegisterPage({super.key});

  @override
  State<EditRegisterPage> createState() => _EditRegisterPageState();
}

class _EditRegisterPageState extends State<EditRegisterPage> {
  final _formKey = GlobalKey<FormState>();

  late TextEditingController _nameController;
  late TextEditingController _emailController;
  late TextEditingController _phoneController;

  bool _loading = false;
  bool _loadingProfile = true;

  Map<String, dynamic>? _userData;

  @override
  void initState() {
    super.initState();
    _nameController = TextEditingController();
    _emailController = TextEditingController();
    _phoneController = TextEditingController();

    _loadUserProfile();
  }

  Future<void> _loadUserProfile() async {
    final response = await AuthService().getProfile();

    if (!mounted) return;

    if (response['success']) {
      final data = response['data']['user'];

      setState(() {
        _userData = data;
        _loadingProfile = false;

        _nameController.text = data['name'] ?? '';
        _emailController.text = data['email'] ?? '';
        _phoneController.text = data['phone'] ?? '';
      });
    } else {
      setState(() => _loadingProfile = false);
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Erro ao carregar dados: ${response['error']}')),
      );
    }
  }

  Future<void> _editRegister() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _loading = true);

    final response = await AuthService().editRegister(
      name: _nameController.text,
      email: _emailController.text,
      phone: _phoneController.text,
      cityId: _userData?['city_id'], // você decide se vai editar cidade depois
    );

    if (!mounted) return;

    setState(() => _loading = false);

    if (response['success']) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Conta atualizada com sucesso!')),
      );
      Navigator.pop(context);
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Erro: ${response['error']}')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    if (_loadingProfile) {
      return const Scaffold(
        body: Center(
          child: CircularProgressIndicator(),
        ),
      );
    }

    return Scaffold(
      appBar: CustomAppBar(titleText: 'Editar Conta'),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              TextFormField(
                controller: _nameController,
                decoration: const InputDecoration(
                    labelText: 'Nome', filled: true, fillColor: Color(0xFFC9A14D)),
              ),
              const SizedBox(height: 12),

              TextFormField(
                controller: _emailController,
                decoration: const InputDecoration(
                    labelText: 'E-mail', filled: true, fillColor: Color(0xFFC9A14D)),
              ),
              const SizedBox(height: 12),

              TextFormField(
                controller: _phoneController,
                decoration: const InputDecoration(
                    labelText: 'Telefone', filled: true, fillColor: Color(0xFFC9A14D)),
              ),
              const SizedBox(height: 20),

              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: _loading ? null : _editRegister,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Color(0xFFC9A14D),
                  ),
                  child: _loading
                      ? const CircularProgressIndicator()
                      : const Text(
                          'Atualizar Conta',
                          style: TextStyle(color: Colors.black),
                        ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
