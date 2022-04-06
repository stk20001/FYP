import mariadb
import sys

# Connect to MariaDB Platform
try:
    conn = mariadb.connect(
        user="root",
        password="4321",
        host="localhost",
        port=3306,
        database="sec_db"

    )
except mariadb.Error as e:
    print(f"Error connecting to MariaDB Platform: {e}")
    sys.exit(1)

# Get Cursor
cur = conn.cursor()

cur.execute("SELECT * FROM email_alert")

result = cur.fetchone()

gmail_address = result[1]
email_address = result[2]
gmail_app_password = result[3]

# Close Connection
conn.close()