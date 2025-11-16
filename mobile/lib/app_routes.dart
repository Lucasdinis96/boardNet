import 'package:flutter/material.dart';
import '../screens/auth_page.dart';
import '../screens/trade_page.dart';
import '../screens/trade_detail_page.dart';
import '../screens/register_page.dart';
import '../screens/editregister_page.dart';

class AppRoutes {
  static const login = '/login';
  static const trade = '/trades';
  static const tradeDetail = '/trades/detail';
  static const register = '/register';
  static const editRegister = '/editRegister';

  static Map<String, WidgetBuilder> routes = {
    login: (context) => const LoginPage(),
    trade: (context) {
      final args = ModalRoute.of(context)!.settings.arguments;
      if (args == null || args is! String) {
        WidgetsBinding.instance.addPostFrameCallback((_) {
          Navigator.pushReplacementNamed(context, AppRoutes.login);
        });
        return const Scaffold(body: Center(child: CircularProgressIndicator()));
      }
      return TradesPage(token: args);
    },
    tradeDetail: (context) {
      final args = ModalRoute.of(context)!.settings.arguments as Map;
      return TradeDetailPage(trade: args['trade']);
    },
    register: (context) => const RegisterPage(),
    editRegister: (context) => EditRegisterPage()
  };
}
