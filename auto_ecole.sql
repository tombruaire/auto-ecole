Drop database if exists auto_ecole;
Create database auto_ecole;
Use auto_ecole;

Drop table if exists users;
Create table if not exists users (
    id_u int(11) not null auto_increment,
    nom varchar(50),
    prenom varchar(50),
    tel varchar(10) UNIQUE,
    adresse varchar(100),
    cp varchar(10),
    email varchar(255) UNIQUE,
    mdp varchar(255),
    lvl int(11) default 1,
    primary key (id_u)
) ENGINE=InnoDB;

Insert into users values

-- Admin
(1, "BRUAIRE", "Tom", "0606060606", "5 rue de Levallois", "92300", "tom@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 3),
(2, "LABASTUGUE", "Lucas", "0707070707", "42, place de Ravioli", "92700", "lucas@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 3),
(3, "CARVALHO", "Ruben", "0808080808", "11, rue Joseph Vernet", "73700", "ruben@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 3),

-- Moniteurs
(4, "LABERGE", "Audric", "0108227875", "51, rue Nationale", "75005", "audric@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 2),
(5, "PAULET", "Thomas", "0490865939", "84, rue Grande Fusterie", "69500", "thomas@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 2),
(6, "BEAUDOIN", "Stéphane", "0516333718", "89, rue Bonneterie", "82000", "stephane@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 2),
(7, "VALLIS", "Gregoire", "0395721045", "20, Avenenue des Pins", "57158", "gregoire@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 2),
(8, "FAVREAU", "Jérôme", "0164924998", "96, Square de la Couronne", "93500", "jerome@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 2),

-- Élèves
(9, "DESNOYER", "Maslin", "0485923092", "90, rue Marie De Médicis", "69300", "maslin@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 1),
(10, "LEMIEUX", "Théodore", "0220261222", "2, rue Petite Fusterie", "18000", "theodore@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 1),
(11, "GAUVIN", "Langley", "0315048268", "9, rue des lieutemants Thomazo", "35000", "langley@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 1),
(12, "GIROUD", "Olivier", "0420439523", "4, rue de la Hulotais", "93700", "olivier@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 1),
(13, "GRONDIN", "Arthur", "0163786455", "17, rue Ernest Renan", "37100", "arthur@gmail.com", "107d348bff437c999a9ff192adcb78cb03b8ddc6", 1);

Drop table if exists lessons;
Create table if not exists lessons (
    id_l int(11) not null auto_increment,
    titre varchar(50),
    description text,
    date_debut datetime,
    date_fin datetime,
    id_e int(11) not null,
    id_m int(11) not null,
    primary key (id_l),
    foreign key (id_e) references users (id_u),
    foreign key (id_m) references users (id_u)
) ENGINE=InnoDB;

Insert into lessons values
(1, "Maitrise de la vitesse", "Conduite en voiture tout en contrôlant la vitesse", "2021-04-15 09:00:00", "2021-04-15 11:00:00", 7, 2),
(2, "Maitrise du volant", "Conduite en voiture tout en contrôlant le volant", "2021-04-21 10:00:00", "2021-04-21 12:00:00", 7, 2);

Create or replace view vLessons (id_l, titre, description, date_debut, date_fin, id_e, id_m) as 
    SELECT l1.id_l, l1.titre, l1.description, l1.date_debut, l1.date_fin, a.nom, b.nom
    FROM lessons l1, lessons l2, users a, users b
    WHERE a.id_u > b.id_u and l1.id_e = a.id_u  and l2.id_m = b.id_u
    and l1.id_l = l2.id_l  and l1.date_debut = l2.date_debut
    and l1.date_fin = l2.date_fin;

Drop table if exists messages;
Create table if not exists messages (
    id_exp int(11) not null,
    id_dest int(11) not null,
    date_envoi datetime,
    contenu text,
    lu int(11) default 0,
    primary key (id_exp, id_dest),
    foreign key (id_exp) references users (id_u)
) ENGINE=InnoDB;

INSERT INTO messages values
(1, 2, "2021-03-11 17:59:37", "Bonjour, ça va ?", 0),
(2, 1, "2021-03-16 17:59:37", "Ça va et toi ?", 1);

Create or replace view vMessages (id_exp, id_dest, date_envoi, contenu, lu) as 
    SELECT a.nom, b.nom, m1.date_envoi, m1.contenu, m1.lu
    FROM users a, users b, messages m1 , messages m2
    WHERE m1.id_exp = a.id_u  and m2.id_dest = b.id_u
    and m1.date_envoi = m2.date_envoi;
