package com.recommender;

import java.sql.*;
import java.io.File;
import java.io.IOException;
import java.util.List;
 
import org.apache.mahout.cf.taste.common.TasteException;
import org.apache.mahout.cf.taste.impl.model.file.FileDataModel;
import org.apache.mahout.cf.taste.impl.neighborhood.ThresholdUserNeighborhood;
import org.apache.mahout.cf.taste.impl.recommender.GenericUserBasedRecommender;
import org.apache.mahout.cf.taste.impl.similarity.EuclideanDistanceSimilarity;
import org.apache.mahout.cf.taste.model.DataModel;
import org.apache.mahout.cf.taste.neighborhood.UserNeighborhood;
import org.apache.mahout.cf.taste.recommender.RecommendedItem;
import org.apache.mahout.cf.taste.recommender.UserBasedRecommender;
import org.apache.mahout.cf.taste.similarity.UserSimilarity;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
 
/**
 * Hay que consultar todos los usuarios que hay en el sistema y generar como máximo 10 recomendaciones para ellos.
 * Habrá que borrar a diario las recomendaciones y añadirlas
 */
public class BasicRecommender {
	
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	static final String DB_URL = "jdbc:mysql://localhost:8889/science_db";

	//  Database credentials
	static final String USER = "root";
	static final String PASS = "root";

    public static void main(String[] args) throws IOException, TasteException {
	Connection conn = null;
   	Statement stmt = null;
   	Statement stmt2 = null;
	String id_usuario = "";

   try{
      //STEP 2: Register JDBC driver
      Class.forName("com.mysql.jdbc.Driver");

      //STEP 3: Open a connection
      System.out.println("Connecting to a selected database...");
      conn = DriverManager.getConnection(DB_URL, USER, PASS);
      System.out.println("Connected database successfully...");
      

      //STEP 4: Execute a query
      System.out.println("Inserting records into the table...");
      stmt = conn.createStatement();
      stmt2 = conn.createStatement();

 		stmt2.executeUpdate("DELETE FROM Recomendacion");


      
		Logger log = LoggerFactory.getLogger(BasicRecommender.class);
 
        // Abrimos el fichero con las votaciones...
        DataModel model = new FileDataModel(new File("input/valorations.csv"));
 
        // Comprobamos la similitud entre usuarios...
        UserSimilarity similarity = new EuclideanDistanceSimilarity(model);
 
        // Creamos el vecindario del usuario con usuarios con los que comparte valoraciones...
        UserNeighborhood neighborhood = new ThresholdUserNeighborhood(0.1,
                similarity, model);
 
        // Se crea la recomendación...
        UserBasedRecommender recommender = new GenericUserBasedRecommender(
                model, neighborhood, similarity);
 
        // Insertarmos todos las recomendaciones para cada usuario...
        ResultSet rs = stmt.executeQuery("SELECT * FROM Usuario");
        while ( rs.next() ) {
            id_usuario = rs.getString("id");         
	        List<RecommendedItem> recommendations = recommender.recommend(Integer.parseInt(id_usuario), 5);
	        for (RecommendedItem recommendation : recommendations) {
	        	String sql = "INSERT INTO Recomendacion VALUES ("+id_usuario+","+ recommendation.getItemID() +")";
			 	stmt2.executeUpdate(sql);
	            log.info("User "+id_usuario+" might like the book with ID: "
	                    + recommendation.getItemID() + " (predicted preference :"
	                    + recommendation.getValue() + ")");
			}
        }

      System.out.println("Inserted records into the table...");

   }catch(SQLException se){
      //Handle errors for JDBC
      se.printStackTrace();
   }catch(Exception e){
      //Handle errors for Class.forName
      e.printStackTrace();
   }finally{
      //finally block used to close resources
      try{
         if(stmt!=null)
            conn.close();
      }catch(SQLException se){
      }// do nothing
      try{
         if(conn!=null)
            conn.close();
      }catch(SQLException se){
         se.printStackTrace();
      }//end finally try
   }//end try
   System.out.println("Goodbye!");

    }
}