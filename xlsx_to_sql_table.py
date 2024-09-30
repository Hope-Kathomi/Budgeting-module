import pandas as pd
import mysql.connector
from pymysql import NULL

# Read CSV file into a DataFrame
df = pd.read_csv('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/Foreign Travel per diems.csv')

# Replace empty strings with NULL values
df.fillna(value=0, inplace=True)

# Establish connection to MySQL database
conn = mysql.connector.connect(host='localhost',
                               user='root',
                               password='sqlAdmin!1',
                               database='dsppgm_db')

# Create a cursor object
cursor = conn.cursor()

# Iterate over DataFrame rows and insert into MySQL table
for _, row in df.iterrows():
    cursor.execute("INSERT INTO dsppgm_db.Per_diems_international_travel (NUM, COUNTRY, NOT_APPLICABLE, KMR1, KMR2, KMR3, KMR4, KMR5, KMR6, KMR7, KMR8, KMR9, KMR10, KMR11, KMR12) VALUES (%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s, %s,%s, %s)", tuple(row))

# Commit changes and close connection
conn.commit()
conn.close()