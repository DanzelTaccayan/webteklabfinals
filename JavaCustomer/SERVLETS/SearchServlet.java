/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.src.uifunctions;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import java.sql.*;
/**
 *
 * @author 21518
 */
public class SearchServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
                String ipt = request.getParameter("search").trim();
    if(ipt != null && !ipt.isEmpty()){
       
    try{
         Class.forName("com.mysql.cj.jdbc.Driver"); 
         Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
         String sql = "SELECT CONCAT(firstname, ' ', middleName, ' ', lastName) as SP, company from user_details inner join services on " 
                   + "user_details.idUser = services.sprovider_id inner join users on " 
                   + "user_details.idUser = users.idUsers WHERE ((user_details.firstname LIKE '?') OR (user_details.middleName LIKE '?') OR (user_details.lastName LIKE '?'))" 
                   + "AND users.usertype = 'SP'";
         PreparedStatement ps = con.prepareStatement(sql);
         ps.setString(1, "%"+ipt+"%");
         ps.setString(2, "%"+ipt+"%");
         ps.setString(3, "%"+ipt+"%");
         ResultSet rs = ps.executeQuery(); 
  
    
    
        while(rs.next()){
            String data = rs.getString("SP");
            out.println(data);
        }      
    }catch(Exception e){
        e.printStackTrace();
    }
}


        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
//    @Override
//    protected void doGet(HttpServletRequest request, HttpServletResponse response)
//            throws ServletException, IOException {
//        processRequest(request, response);
//    }

//    /**
//     * Handles the HTTP <code>POST</code> method.
//     *
//     * @param request servlet request
//     * @param response servlet response
//     * @throws ServletException if a servlet-specific error occurs
//     * @throws IOException if an I/O error occurs
//     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }


}
