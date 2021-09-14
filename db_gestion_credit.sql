USE [master]
GO
/****** Object:  Database [db_gestion_credit]    Script Date: 14/09/2021 07:22:55 ******/
CREATE DATABASE [db_gestion_credit]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'db_gestion_credit', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS01\MSSQL\DATA\db_gestion_credit.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'db_gestion_credit_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS01\MSSQL\DATA\db_gestion_credit_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
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
ALTER DATABASE [db_gestion_credit] SET AUTO_CLOSE ON 
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
ALTER DATABASE [db_gestion_credit] SET  ENABLE_BROKER 
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
/****** Object:  Table [dbo].[agence]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[agence](
	[id_agence] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_agence] [varchar](50) NOT NULL,
	[id_pole] [smallint] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_agence] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[but]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[but](
	[id_but] [int] IDENTITY(1,1) NOT NULL,
	[nom_but] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_but] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[client]    Script Date: 14/09/2021 07:22:56 ******/
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
	[id_agence] [smallint] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_client] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[document]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[document](
	[id_document] [int] IDENTITY(1,1) NOT NULL,
	[nom_document] [varchar](50) NOT NULL,
	[id_client] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_document] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[engagement]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[engagement](
	[num_dossier] [int] IDENTITY(1,1) NOT NULL,
	[montant_dmd] [float] NOT NULL,
	[montant_acc] [float] NOT NULL,
	[nbre_echeance] [smallint] NOT NULL,
	[periodicite] [varchar](30) NOT NULL,
	[statut] [smallint] NOT NULL,
	[id_type_pret] [int] NOT NULL,
	[id_type_engagement] [int] NOT NULL,
	[id_client] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[num_dossier] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pole]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pole](
	[id_pole] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_pole] [varchar](50) NOT NULL,
	[id_section] [smallint] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_pole] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[reseau]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[reseau](
	[id_reseau] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_reseau] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_reseau] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[section]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[section](
	[id_section] [smallint] IDENTITY(1,1) NOT NULL,
	[nom_section] [varchar](50) NOT NULL,
	[id_reseau] [smallint] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_section] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[traiter]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[traiter](
	[id_traiter] [int] IDENTITY(1,1) NOT NULL,
	[date_debut] [date] NOT NULL,
	[date_fin] [date] NOT NULL,
	[opinion] [varchar](100) NULL,
	[id_users] [int] NOT NULL,
	[num_dossier] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_traiter] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[type_engagement]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[type_engagement](
	[id_type_engagement] [int] IDENTITY(1,1) NOT NULL,
	[nature] [varchar](50) NOT NULL,
	[id_but] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_type_engagement] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[type_pret]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[type_pret](
	[id_type_pret] [int] IDENTITY(1,1) NOT NULL,
	[nom_type_pret] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_type_pret] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 14/09/2021 07:22:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id_users] [int] IDENTITY(1,1) NOT NULL,
	[mdp] [varchar](8) NOT NULL,
	[users_profile] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_users] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[agence]  WITH CHECK ADD  CONSTRAINT [fk_pole_contenir_agence] FOREIGN KEY([id_pole])
REFERENCES [dbo].[pole] ([id_pole])
GO
ALTER TABLE [dbo].[agence] CHECK CONSTRAINT [fk_pole_contenir_agence]
GO
ALTER TABLE [dbo].[client]  WITH CHECK ADD  CONSTRAINT [fk_agence_posseder_client] FOREIGN KEY([id_agence])
REFERENCES [dbo].[agence] ([id_agence])
GO
ALTER TABLE [dbo].[client] CHECK CONSTRAINT [fk_agence_posseder_client]
GO
ALTER TABLE [dbo].[document]  WITH CHECK ADD  CONSTRAINT [fk_client_rattacher_document] FOREIGN KEY([id_client])
REFERENCES [dbo].[client] ([id_client])
GO
ALTER TABLE [dbo].[document] CHECK CONSTRAINT [fk_client_rattacher_document]
GO
ALTER TABLE [dbo].[engagement]  WITH CHECK ADD  CONSTRAINT [fk_engagement_avoir_type_engage] FOREIGN KEY([id_type_engagement])
REFERENCES [dbo].[type_engagement] ([id_type_engagement])
GO
ALTER TABLE [dbo].[engagement] CHECK CONSTRAINT [fk_engagement_avoir_type_engage]
GO
ALTER TABLE [dbo].[engagement]  WITH CHECK ADD  CONSTRAINT [fk_engagement_correspond_type_pret] FOREIGN KEY([id_type_pret])
REFERENCES [dbo].[type_pret] ([id_type_pret])
GO
ALTER TABLE [dbo].[engagement] CHECK CONSTRAINT [fk_engagement_correspond_type_pret]
GO
ALTER TABLE [dbo].[engagement]  WITH CHECK ADD  CONSTRAINT [fk_engagement_demander_client] FOREIGN KEY([id_client])
REFERENCES [dbo].[client] ([id_client])
GO
ALTER TABLE [dbo].[engagement] CHECK CONSTRAINT [fk_engagement_demander_client]
GO
ALTER TABLE [dbo].[pole]  WITH CHECK ADD  CONSTRAINT [fk_section_diviser_pole] FOREIGN KEY([id_section])
REFERENCES [dbo].[section] ([id_section])
GO
ALTER TABLE [dbo].[pole] CHECK CONSTRAINT [fk_section_diviser_pole]
GO
ALTER TABLE [dbo].[section]  WITH CHECK ADD  CONSTRAINT [fk_reseau_comporte_section] FOREIGN KEY([id_reseau])
REFERENCES [dbo].[reseau] ([id_reseau])
GO
ALTER TABLE [dbo].[section] CHECK CONSTRAINT [fk_reseau_comporte_section]
GO
ALTER TABLE [dbo].[traiter]  WITH CHECK ADD  CONSTRAINT [fk_traiter_engagement] FOREIGN KEY([num_dossier])
REFERENCES [dbo].[engagement] ([num_dossier])
GO
ALTER TABLE [dbo].[traiter] CHECK CONSTRAINT [fk_traiter_engagement]
GO
ALTER TABLE [dbo].[traiter]  WITH CHECK ADD  CONSTRAINT [fk_traiter_users] FOREIGN KEY([id_users])
REFERENCES [dbo].[users] ([id_users])
GO
ALTER TABLE [dbo].[traiter] CHECK CONSTRAINT [fk_traiter_users]
GO
ALTER TABLE [dbo].[type_engagement]  WITH CHECK ADD  CONSTRAINT [fk_type_eng_avoir_pour_but] FOREIGN KEY([id_but])
REFERENCES [dbo].[but] ([id_but])
GO
ALTER TABLE [dbo].[type_engagement] CHECK CONSTRAINT [fk_type_eng_avoir_pour_but]
GO
USE [master]
GO
ALTER DATABASE [db_gestion_credit] SET  READ_WRITE 
GO
