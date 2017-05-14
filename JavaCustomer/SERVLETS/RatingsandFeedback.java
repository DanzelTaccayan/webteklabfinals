/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.src.uifunctions;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author Lydwald
 */
public class RatingsandFeedback extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            int spid = Integer.parseInt(request.getParameter("evaluatee"));
            String fdback = request.getParameter("user_feedback");

            
            try{
                String driverName = "com.mysql.jdbc.Driver";
                Class.forName(driverName);
                String url = "jdbc:mysql://localhost:3306/webtekfinals";
                String user = "root";
                String password = "winter";
                Connection con = DriverManager.getConnection(url, user, password);
                String sql1 = "SELECT * FROM feedback WHERE sender = 6 and recepient = "+spid+"";
                
                PreparedStatement ps = con.prepareStatement(sql1);

                ResultSet rs =  ps.executeQuery();
                if(rs.next()){
                    String sql2 = "update feedback set content='"+fdback+"' where sender = 6 and recepient = "+spid+"";
                    PreparedStatement ps2 = con.prepareStatement(sql2);
                    int count = ps2.executeUpdate();
                    
                }else{
                    String sql3 = "insert into feedback(content, sender, recepient) values ('"+fdback+"', 6, "+spid+")";
                    PreparedStatement ps3 = con.prepareStatement(sql3);
                    int c2 = ps3.executeUpdate();
                    
                }
                //            int rting = Integer.parseInt(request.getParameter("user_ratings"));
               String rngs = request.getParameter("user_ratings");
                if(rngs != "" || rngs != null){
                     try{
                        int rting = Integer.parseInt(request.getParameter("user_ratings"));
                        String sqla1 = "insert into rating(evaluator, evaluatee, rating) values(6, "+spid+", "+rting+")";
                        PreparedStatement px = con.prepareStatement(sqla1);
                        ResultSet rx = px.executeQuery();
                        
                        
                     }catch(Exception ex){
                         out.println("<script>alert('PUTA')</script>");
                     }
                }
                HttpSession sexion = request.getSession();
                sexion.setAttribute("showNotifSuccess", "Yes");
                response.sendRedirect("ratingandfeedbacks.jsp");
            }catch(Exception e){
                out.println("<script>alert('PUTA')</script>");
            }
            
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

}
