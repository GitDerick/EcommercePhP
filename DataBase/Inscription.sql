-- creation de la base de donnee
drop database if exists AchatVente;
create database AchatVente;
use AchatVente;

-- creation des tables

create table Role(
    id int primary key auto_increment not null,
    titre varchar(50)
);

create table Utilisateur(
    id int primary key auto_increment not null,
    nom varchar(50) not null,
    prenom varchar(50),
    sexe varchar(25),
    date_de_naissance varchar(12),
    email varchar(50) not null,
    mot_de_passe varchar(255) not null,
    telephone varchar(50),
    date_creation datetime,
    date_mise_jour datetime
);



create table UtilisateurRole(
    id_utilisateur int,
    id_role int,
    primary key(id_role,id_utilisateur),
    foreign key(id_role) references Role(id)
);

alter table UtilisateurRole
    add constraint fk_utilisateur_utilisateurrole
    foreign key(id_utilisateur) references Utilisateur(id);

create table Adresse(
 id int primary key auto_increment not null,
 rue varchar(50),
 ville varchar(50) not null,
 pays varchar(50) not null,
 numero_appartement varchar(10),
 code_postal varchar(10)
);

create table UtilisateurAdresse(
    id_utilisateur int,
    id_adresse int,
    primary key(id_adresse,id_utilisateur)
);

create table creation(
    id int primary key auto_increment not null,
    nom varchar(50) not null,
    prix float not null,
    nombre_de_produit int,
    date_affiche datetime,
    description varchar(255)
);

create table Image(
    id int primary key auto_increment not null,
    chemin varchar(255) not null,
    id_creation int
);

alter table Image
    add constraint fk_creation_image
    foreign key(id_creation) references creation(id) on update cascade on delete cascade,


alter table UtilisateurAdresse
    Add constraint fk_utilisateur_utilisateuradresse
    foreign key(id_utilisateur) references Utilisateur(id) on update cascade 
    on delete cascade,
    Add constraint fk_adresse_utilisateuradresse
    foreign key(id_adresse) references Adresse(id) on update cascade 
    on delete cascade;

-- insertion d'un utilisateur

insert into Utilisateur(nom,prenom,email,date_de_naissance,date_creation,mot_de_passe)
            values 
            ("Tom","Jerry","tom@gmail.ca","2022-07-06","2023-07-02 17:37:32","Tom1234");


create table Commande(
    id_commande int primary key auto_increment,
    total float, 
    date_commande varchar(50),
    id_user int
);

create table CommandeProduit(
    id_commande int,
    id int,
    nombre_de_produit int
);

alter table Commande
    add constraint fk_commande_utilisateur
    foreign key (id_user) references Utilisateur(id);


alter table CommandeProduit
    add constraint fk_commande_produit
    foreign key (id_commande) references Commande (id_commande) on update cascade on delete cascade,
    add constraint fk_produit_commande
    foreign key (id) references creation(id) on update cascade on delete cascade;


