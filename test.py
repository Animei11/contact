import MySQLdb
import webbrowser
import os
# from pyembedded.rfid_module.rfid import RFID
db = MySQLdb.connect("localhost", "root", "", "help_desk")
action = db.cursor()
#Shows all databases in phpmyadmin
# sqlquery = "SHOW DATABASES"


# Adds someone to queue list
def insert(user, employee_id, problem):
    # print(f"{user}")
    action.execute(f"INSERT INTO queue_list(User, EmployeeID, Problem) VALUES ('{user}', '{employee_id}', '{problem}')")
    db.commit()


# Deletes user and updates queue list
def delete(user):
    action.execute(f"DELETE FROM `queue_list` WHERE User = '{user}'")
    action.execute(f"UPDATE `queue_list` SET `User`='[value-1]',`EmployeeID`='[value-2]',`Problem`='[value-3]' WHERE 1")
    db.commit()


# Displays everyone that is on the queue list
def display_queue_list():
    sqlquery = "SELECT * FROM queue_list"
    action.execute(sqlquery)
    for x in action:
        print(x)


# insert("Wilmore, Drew", 100, "Nothing")
# display_queue_list()
# print()
# delete("Wilmore, Drew")
# display_queue_list()

# to open/create a new html file in the write mode
f = open('GFG.html', 'w')

# the html code which will go in the file GFG.html
html_template = """
<html>

<head>

<title>

Read CSV with Pandas using PyScript
    
</title>

<link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css" />
<script defer src="https://pyscript.net/alpha/pyscript.js"></script>

<!---pyodide--> 

<py-env>
    - pandas
</py-env>

</head>

<body>
    
    <h1>Read CSV with Pandas using PyScript</h1>

    <p id="csv"></p>

    <py-script>

        import pandas as pd 

        import sqlite3 as sql


        from pyodide.http import open_url

        # read csv using pandas 

        url_content = open_url("https://raw.githubusercontent.com/mwaskom/seaborn-data/master/diamonds.csv")

        diamonds = pd.read_csv(url_content)

        # create a sqllite table 

        conn = sql.connect('diamonds.db')
        diamonds.to_sql('diamonds', conn)

        # read from sql into a pandas dataframe

        df = pd.read_sql('SELECT cut, avg(price) as avg_price FROM diamonds group by 1', conn)

        # print the output back
        
        csv = Element('csv')

        csv.write(df)

        print(df.shape)

    </py-script>

</body>

</html>
"""
# writing the code into the file
f.write(html_template)

# close the file
f.close()

# 1st method how to open html files in chrome using
filename = 'file:///' + os.getcwd() + '/' + 'GFG.html'
webbrowser.open_new_tab(filename)