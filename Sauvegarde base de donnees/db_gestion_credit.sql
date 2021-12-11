USE [master]
GO
/****** Object:  Database [db_gestion_credit]    Script Date: 11/12/2021 14:39:09 ******/
CREATE DATABASE [db_gestion_credit]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'db_gestion_credit_Data', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS01\MSSQL\DATA\db_gestion_credit.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'db_gestion_credit_Log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS01\MSSQL\DATA\db_gestion_credit.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [db_gestion_credit] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [db_gestion_credit].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [db_gestion_credit] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [db_gestion_credit] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [db_gestion_credit] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [db_gestion_credit] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [db_gestion_credit] SET ARITHABORT OFF 
GO
ALTER DATABASE [db_gestion_credit] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [db_gestion_credit] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [db_gestion_credit] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [db_gestion_credit] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [db_gestion_credit] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [db_gestion_credit] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [db_gestion_credit] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [db_gestion_credit] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [db_gestion_credit] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [db_gestion_credit] SET  DISABLE_BROKER 
GO
ALTER DATABASE [db_gestion_credit] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [db_gestion_credit] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [db_gestion_credit] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [db_gestion_credit] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [db_gestion_credit] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [db_gestion_credit] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [db_gestion_credit] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [db_gestion_credit] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [db_gestion_credit] SET  MULTI_USER 
GO
ALTER DATABASE [db_gestion_credit] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [db_gestion_credit] SET DB_CHAINING OFF 
GO
ALTER DATABASE [db_gestion_credit] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [db_gestion_credit] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [db_gestion_credit] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [db_gestion_credit] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [db_gestion_credit] SET QUERY_STORE = OFF
GO
USE [db_gestion_credit]
GO
/****** Object:  Table [dbo].[agence]    Script Date: 11/12/2021 14:39:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[agence](
	[id_agence] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_agence] [varchar](50) NOT NULL,
	[id_pole] [smallint] NOT NULL,
 CONSTRAINT [PK_agence] PRIMARY KEY CLUSTERED 
(
	[id_agence] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[but]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[but](
	[id_but] [int] IDENTITY(1,1) NOT NULL,
	[nom_but] [varchar](60) NOT NULL,
	[id_type_engagement] [int] NOT NULL,
 CONSTRAINT [PK_but] PRIMARY KEY CLUSTERED 
(
	[id_but] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[client]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[client](
	[id_client] [int] IDENTITY(1,1) NOT NULL,
	[num_client] [varchar](50) NOT NULL,
	[nom_client] [varchar](50) NOT NULL,
	[prenom_client] [varchar](50) NOT NULL,
	[email_client] [varchar](50) NULL,
	[telephone_client] [varchar](50) NOT NULL,
	[id_agence] [smallint] NOT NULL,
 CONSTRAINT [PK_client] PRIMARY KEY CLUSTERED 
(
	[id_client] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[compteur]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[compteur](
	[compteur_id] [int] IDENTITY(1,1) NOT NULL,
	[compteur] [int] NOT NULL,
 CONSTRAINT [PK_compteur] PRIMARY KEY CLUSTERED 
(
	[compteur_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[document]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[document](
	[id_document] [int] IDENTITY(1,1) NOT NULL,
	[nom_document] [varchar](255) NOT NULL,
	[date_document] [datetime] NOT NULL,
	[id_client] [int] NOT NULL,
 CONSTRAINT [PK_document] PRIMARY KEY CLUSTERED 
(
	[id_document] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[engagement]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[engagement](
	[num_dossier] [int] IDENTITY(1,1) NOT NULL,
	[montant_dmd] [float] NOT NULL,
	[montant_acc] [float] NULL,
	[statut] [smallint] NOT NULL,
	[periodicite] [varchar](50) NOT NULL,
	[echeance] [date] NOT NULL,
	[id_client] [int] NOT NULL,
	[id_typePret] [int] NOT NULL,
	[id_but] [int] NOT NULL,
 CONSTRAINT [PK_engagement] PRIMARY KEY CLUSTERED 
(
	[num_dossier] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[menu]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[menu](
	[id_menu] [int] IDENTITY(1,1) NOT NULL,
	[nom_menu] [varchar](50) NOT NULL,
 CONSTRAINT [PK_menu] PRIMARY KEY CLUSTERED 
(
	[id_menu] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pole]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pole](
	[id_pole] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_pole] [varchar](50) NOT NULL,
	[id_section] [smallint] NOT NULL,
 CONSTRAINT [PK_pole] PRIMARY KEY CLUSTERED 
(
	[id_pole] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[profil]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[profil](
	[id_profil] [int] IDENTITY(1,1) NOT NULL,
	[nom_profil] [varchar](50) NOT NULL,
 CONSTRAINT [PK_profil] PRIMARY KEY CLUSTERED 
(
	[id_profil] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[profil_menu]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[profil_menu](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_menu] [int] NOT NULL,
	[id_profil] [int] NOT NULL,
 CONSTRAINT [PK_profil_menu] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[reseau]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[reseau](
	[id_reseau] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_reseau] [varchar](50) NOT NULL,
	[code_admin] [int] NOT NULL,
	[mdp_admin] [varchar](8) NOT NULL,
	[nom_admin] [varchar](50) NOT NULL,
 CONSTRAINT [PK_reseau] PRIMARY KEY CLUSTERED 
(
	[id_reseau] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[section]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[section](
	[id_section] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_section] [varchar](50) NOT NULL,
	[id_reseau] [smallint] NOT NULL,
 CONSTRAINT [PK_section] PRIMARY KEY CLUSTERED 
(
	[id_section] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[traiter]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[traiter](
	[id_traiter] [int] IDENTITY(1,1) NOT NULL,
	[date_debut] [datetime] NULL,
	[date_fin] [datetime] NULL,
	[opinion] [text] NULL,
	[num_dossier] [int] NOT NULL,
	[id_user] [int] NOT NULL,
 CONSTRAINT [PK_traiter] PRIMARY KEY CLUSTERED 
(
	[id_traiter] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[type_engagement]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[type_engagement](
	[id_type_engagement] [int] IDENTITY(1,1) NOT NULL,
	[nature] [varchar](50) NOT NULL,
 CONSTRAINT [PK_type_engagement] PRIMARY KEY CLUSTERED 
(
	[id_type_engagement] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[typePret]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[typePret](
	[id_typePret] [int] IDENTITY(1,1) NOT NULL,
	[nom_typePret] [varchar](50) NOT NULL,
 CONSTRAINT [PK_typePret] PRIMARY KEY CLUSTERED 
(
	[id_typePret] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 11/12/2021 14:39:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id_user] [int] IDENTITY(1,1) NOT NULL,
	[nom_user] [varchar](50) NOT NULL,
	[mdp] [varchar](8) NOT NULL,
	[id_reseau] [smallint] NOT NULL,
	[id_section] [smallint] NOT NULL,
	[id_pole] [smallint] NOT NULL,
	[id_agence] [smallint] NOT NULL,
	[id_profil] [int] NOT NULL,
 CONSTRAINT [PK_users] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[compteur] ADD  CONSTRAINT [DF_compteur_compteur]  DEFAULT ((0)) FOR [compteur]
GO
ALTER TABLE [dbo].[agence]  WITH CHECK ADD  CONSTRAINT [FK_agence_pole] FOREIGN KEY([id_pole])
REFERENCES [dbo].[pole] ([id_pole])
GO
ALTER TABLE [dbo].[agence] CHECK CONSTRAINT [FK_agence_pole]
GO
ALTER TABLE [dbo].[but]  WITH CHECK ADD  CONSTRAINT [FK_but_type_engagement] FOREIGN KEY([id_type_engagement])
REFERENCES [dbo].[type_engagement] ([id_type_engagement])
GO
ALTER TABLE [dbo].[but] CHECK CONSTRAINT [FK_but_type_engagement]
GO
ALTER TABLE [dbo].[client]  WITH CHECK ADD  CONSTRAINT [FK_client_agence] FOREIGN KEY([id_agence])
REFERENCES [dbo].[agence] ([id_agence])
GO
ALTER TABLE [dbo].[client] CHECK CONSTRAINT [FK_client_agence]
GO
ALTER TABLE [dbo].[document]  WITH CHECK ADD  CONSTRAINT [FK_document_client] FOREIGN KEY([id_client])
REFERENCES [dbo].[client] ([id_client])
GO
ALTER TABLE [dbo].[document] CHECK CONSTRAINT [FK_document_client]
GO
ALTER TABLE [dbo].[engagement]  WITH CHECK ADD  CONSTRAINT [FK_engagement_but] FOREIGN KEY([id_but])
REFERENCES [dbo].[but] ([id_but])
GO
ALTER TABLE [dbo].[engagement] CHECK CONSTRAINT [FK_engagement_but]
GO
ALTER TABLE [dbo].[engagement]  WITH CHECK ADD  CONSTRAINT [FK_engagement_client] FOREIGN KEY([id_client])
REFERENCES [dbo].[client] ([id_client])
GO
ALTER TABLE [dbo].[engagement] CHECK CONSTRAINT [FK_engagement_client]
GO
ALTER TABLE [dbo].[engagement]  WITH CHECK ADD  CONSTRAINT [FK_engagement_typePret] FOREIGN KEY([id_typePret])
REFERENCES [dbo].[typePret] ([id_typePret])
GO
ALTER TABLE [dbo].[engagement] CHECK CONSTRAINT [FK_engagement_typePret]
GO
ALTER TABLE [dbo].[pole]  WITH CHECK ADD  CONSTRAINT [FK_pole_section] FOREIGN KEY([id_section])
REFERENCES [dbo].[section] ([id_section])
GO
ALTER TABLE [dbo].[pole] CHECK CONSTRAINT [FK_pole_section]
GO
ALTER TABLE [dbo].[profil_menu]  WITH CHECK ADD  CONSTRAINT [FK_profil_menu_menu] FOREIGN KEY([id_menu])
REFERENCES [dbo].[menu] ([id_menu])
GO
ALTER TABLE [dbo].[profil_menu] CHECK CONSTRAINT [FK_profil_menu_menu]
GO
ALTER TABLE [dbo].[profil_menu]  WITH CHECK ADD  CONSTRAINT [FK_profil_menu_profil] FOREIGN KEY([id_profil])
REFERENCES [dbo].[profil] ([id_profil])
GO
ALTER TABLE [dbo].[profil_menu] CHECK CONSTRAINT [FK_profil_menu_profil]
GO
ALTER TABLE [dbo].[section]  WITH CHECK ADD  CONSTRAINT [FK_section_reseau] FOREIGN KEY([id_reseau])
REFERENCES [dbo].[reseau] ([id_reseau])
GO
ALTER TABLE [dbo].[section] CHECK CONSTRAINT [FK_section_reseau]
GO
ALTER TABLE [dbo].[traiter]  WITH CHECK ADD  CONSTRAINT [FK_traiter_engagement] FOREIGN KEY([num_dossier])
REFERENCES [dbo].[engagement] ([num_dossier])
GO
ALTER TABLE [dbo].[traiter] CHECK CONSTRAINT [FK_traiter_engagement]
GO
ALTER TABLE [dbo].[traiter]  WITH CHECK ADD  CONSTRAINT [FK_traiter_users] FOREIGN KEY([id_user])
REFERENCES [dbo].[users] ([id_user])
GO
ALTER TABLE [dbo].[traiter] CHECK CONSTRAINT [FK_traiter_users]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_agence] FOREIGN KEY([id_agence])
REFERENCES [dbo].[agence] ([id_agence])
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_agence]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_pole] FOREIGN KEY([id_pole])
REFERENCES [dbo].[pole] ([id_pole])
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_pole]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_profil] FOREIGN KEY([id_profil])
REFERENCES [dbo].[profil] ([id_profil])
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_profil]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_reseau] FOREIGN KEY([id_reseau])
REFERENCES [dbo].[reseau] ([id_reseau])
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_reseau]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_section] FOREIGN KEY([id_section])
REFERENCES [dbo].[section] ([id_section])
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_section]
GO
USE [master]
GO
ALTER DATABASE [db_gestion_credit] SET  READ_WRITE 
GO
