/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.src.login;
import java.sql.*;

public class Validate{
     public static boolean checkUser(String user,String pass){
      boolean st =false;
      try{
         Class.forName("com.mysql.jdbc.Driver"); 
         Connection con=DriverManager.getConnection
                        ("jdbc:mysql://localhost:3306/initialdb","root","");
         PreparedStatement ps =con.prepareStatement
                             ("select * from users WHERE UserName=? and Password=?");
         ps.setString(1, user);
         ps.setString(2, pass);
         ResultSet rs =ps.executeQuery();
         st = rs.next();
      }catch(Exception e){
          e.printStackTrace();
      }
         return st;                 
  }   
}