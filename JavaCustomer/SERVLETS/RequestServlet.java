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
import java.util.ArrayList;
import javax.servlet.RequestDispatcher;
import javax.servlet.http.HttpSession;
/**
 *
 * @author 21518
 */
public class RequestServlet extends HttpServlet {

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
            int serviceId = Integer.parseInt(request.getParameter("sid"));
            int sProviderId = Integer.parseInt(request.getParameter("spid"));
            String reqDate = request.getParameter("reqdate");
            String reqTime = request.getParameter("reqtime");
            String desc = request.getParameter("desc");
            if(compareDateAndTime(reqDate, reqTime, sProviderId, serviceId) == false){
                try{
                    Class.forName("com.mysql.cj.jdbc.Driver"); 
                    Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
                    String sql = "INSERT INTO request (status, requested_by, requested_to, service_id, request_date, time_needed, updated_at, description) "
                            + "VALUES ('pending', '4', ?, ?, ?, ?, NOW(), ?);";
                    PreparedStatement ps = con.prepareStatement(sql);
                    ps.setInt(1, sProviderId);
                    ps.setInt(2, serviceId);
                    ps.setString(3, reqDate);
                    ps.setString(4, reqTime);
                    ps.setString(5, desc);
                    ps.executeUpdate();
                    HttpSession s = request.getSession();
                    s.setAttribute("getAlert", "Yes");
                    response.sendRedirect(response.encodeRedirectURL("http://" + request.getServerName() + ":8080/WebTechFinals/serv.jsp?add=success"));
                }catch(Exception e){
                    out.println("<h1>FUCK</h1>");
                    e.printStackTrace();
                }
            }else{
                HttpSession ss = request.getSession();
                ss.setAttribute("getAlert", "No");
                response.sendRedirect(response.encodeRedirectURL("http://" + request.getServerName() + ":8080/WebTechFinals/serv.jsp?add=fail"));
            }
        }
    }
    
    public static boolean compareDateAndTime(String rDate, String rTime, int provId, int sevId){
        boolean exists = false;
        try{
            Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/webtekfinals","root","");
            String sql = "SELECT request_date, time_needed, requested_to, service_id FROM request WHERE (request_date = ? and time_needed = ? and requested_to = ? and service_id = ?) AND status = 'approve'";
            PreparedStatement p = con.prepareStatement(sql);
            p.setString(1,rDate);
            p.setString(2,rTime);
            p.setInt(3, provId);
            p.setInt(4, sevId);
            ResultSet r = p.executeQuery();
            if(r.next() == true){
                exists = true;
            }else{
                exists = false;
            }
        }catch(Exception e){
            
        }
        return exists;
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

}
