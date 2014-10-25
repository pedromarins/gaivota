#cria banco
CREATE DATABASE gaivota;

#entra no banco novo
USE gaivota;

#cria tabela station
CREATE TABLE station ( 
stationId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
owner varchar(255),
email varchar(255),
type varchar(255),
latitude float,
longitude float,
hash varchar(255)
);

#cria tabela rawdata
CREATE TABLE rawdata ( 
dataId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
stationId int,
type varchar(255),
latitude float,
longitude float,
time bigint,
ambientTemperature float,
soilTemperature float,
waterTemperature float,
airHumidity float,
pressure float,
co float,
airParticle float,
windSpeed float,
windDirection float,
soilHumidity float,
waterTurbidity float,
waterSalinity float
);
