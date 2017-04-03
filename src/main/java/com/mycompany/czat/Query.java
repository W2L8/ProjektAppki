/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.czat;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;
import javax.ws.rs.GET;
import javax.ws.rs.Path;

/**
 *
 * @author hubert
 */

@Path("logowanie")
public class Query {
    
    private java.sql.Statement stmt = null;
    ResultSet rs = null;
    
    
    @GET
    public String login() throws ClassNotFoundException, SQLException
    {
        if(ConnectDatabase.Connect() == null)
        {
            return "Error while connect to database";
        }
        else
        {
            stmt = ConnectDatabase.Connect().createStatement();
            ResultSet rs = stmt.executeQuery("SELECT * FROM USERS");
            
            while(rs.next())
            {
                return rs.getString("login");
            }
        }
        
        return "ss";
    }
    
}
