#cria banco
CREATE DATABASE gaivota;

#entra no banco novo
USE gaivota;

#cria tabela station
CREATE TABLE station ( 
station_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
owner varchar(255),
email varchar(255),
type varchar(255),
latitude float,
longitude float,
hash varchar(255)
);

#cria tabela rawdata
CREATE TABLE rawdata ( 
data_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
station_id int,
type varchar(255),
latitude float,
longitude float,
time bigint,
air_temperature float,
soil_temperature float,
water_temperature float,
air_humidity float,
air_pressure float,
air_co2 float,
air_particule float,
wind_speed float,
wind_direction float,
soil_humidity float,
water_turbidity float,
water_salinity float
);
