import 'package:flutter/material.dart';
import '../app_routes.dart';
import 'package:mobile/services/auth_service.dart';

class CustomAppBar extends StatelessWidget implements PreferredSizeWidget {

  final AuthService authService = AuthService();
  final String titleText;
  final List<Widget>? actions;
  final Widget? leading;
  final Color? backgroundColor;
  final String? token;
  final Map<String, dynamic>? userData;

  CustomAppBar ({
    Key? key,
    required this.titleText,
    this.actions,
    this.leading,
    this.backgroundColor,
    this.token,
    this.userData
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return AppBar(
      title: Text(titleText, style: TextStyle(color: Color(0xFFC9A14D))),
      centerTitle: true,
      iconTheme: const IconThemeData(color: Color(0xFFC9A14D)),
      actions: [
        IconButton(onPressed: () async {Navigator.pushNamed(context, AppRoutes.editRegister, arguments: userData);}, icon: Icon(Icons.account_circle, color:Color(0xFFC9A14D))),
        IconButton(onPressed: () async {await authService.logout(); Navigator.pushReplacementNamed(context, '/login');}, icon: Icon(Icons.logout, color:Color(0xFFC9A14D)))
      ],
      leading: leading,
      backgroundColor: Colors.black,
    );
  }

  @override
  Size get preferredSize => const Size.fromHeight(kToolbarHeight);

}