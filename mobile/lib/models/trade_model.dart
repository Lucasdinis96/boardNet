class Trade {
  final int id;
  final String title;
  final String? description;
  final User user;
  final List<Boardgame> boardgames;

  Trade({
    required this.id,
    required this.title,
    required this.description,
    required this.user,
    required this.boardgames,
  });

  factory Trade.fromJson(Map<String, dynamic> json) {
    return Trade(
      id: json['id'],
      title: json['title'],
      description: json['description'],
      user: User.fromJson(json['user']),
      boardgames: (json['boardgames'] as List)
          .map((b) => Boardgame.fromJson(b))
          .toList(),
    );
  }
}

class User {
  final int id;
  final String name;
  final String email;
  final String phone;
  final int cityId;

  User({
    required this.id,
    required this.name,
    required this.email,
    required this.phone,
    required this.cityId,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      phone: json['phone'],
      cityId: json['city_id'],
    );
  }
}

class Boardgame {
  final int id;
  final String title;
  final String cover;
  final double value;
  final String playtime;

  Boardgame({
    required this.id,
    required this.title,
    required this.cover,
    required this.value,
    required this.playtime
  });

  factory Boardgame.fromJson(Map<String, dynamic> json) {
    return Boardgame(
      id: json['id'],
      title: json['title'],
      cover: json['cover'],
      value: (json['pivot']?['value'] ?? 0).toDouble(),
      playtime: (json['playtime'])
    );
  }
}
