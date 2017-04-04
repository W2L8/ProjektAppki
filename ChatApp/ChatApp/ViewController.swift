//
//  ViewController.swift
//  ChatApp
//
//  Created by Maciej Mazurek on 03.04.2017.
//  Copyright © 2017 Maciej Mazurek. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

    
    @IBAction func logIn(_ sender: UIButton) {
        performSegue(withIdentifier: "segue", sender: self)
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

