/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.czat;

import java.sql.Connection;
import java.sql.SQLException;

/**
 *
 * @author hubert
 */
public class ConnectDatabase {
    
    public static Connection Connect() throws ClassNotFoundException, SQLException
    {
        Class.forName("org.firebirdsql.jdbc.FBDriver");
        
        String URL = "jdbc:firebirdsql:188.213.165.178/3050:"
                + "/czat.fdb?lc_ctype=WIN1250"; 
        
        java.sql.Connection connection = null;
        
        try
        {
            connection = 
                java.sql.DriverManager.getConnection(URL, "SYSDBA", "root");
        }
        catch(Exception e)
        {
            return null;
        }
        
        return connection;
    }
    
}
