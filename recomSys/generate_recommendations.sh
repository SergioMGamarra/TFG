#!/bin/bash

mv ../aux/valorations.csv input/
mvn exec:java -Dexec.mainClass="com.recommender.BasicRecommender"
