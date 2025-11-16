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
      boardgames: (json['boardgames'] as List).map((b) => Boardgame.fromJson(b)).toList(),
    );
  }
}

class User {
  final String name;
  final String email;
  final String phone;
  final String city;

  User({
    required this.name,
    required this.email,
    required this.phone,
    required this.city,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      name: json['name'],
      email: json['email'],
      phone: json['phone'],
      city: json['city'],
    );
  }
}

class Boardgame {
  final int id;
  final String title;
  final double value;
  final String playtime;
  final String ageRange;
  final String players;

  Boardgame({
    required this.id,
    required this.title,
    required this.value,
    required this.playtime,
    required this.ageRange,
    required this.players
  });

  factory Boardgame.fromJson(Map<String, dynamic> json) {
    return Boardgame(
      id: json['id'],
      title: json['title'],
      value: (json['value']).toDouble(),
      playtime: (json['playtime']),
      ageRange: (json['age_range']),
      players: (json['players']),
    );
  }
}
