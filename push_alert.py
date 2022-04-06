import smtplib
from email.message import EmailMessage
from email_connection import *

def email_alert(subject, body, to):
    msg = EmailMessage()
    msg.set_content(body)
    msg['subject'] = subject
    msg['to'] = to

    user = gmail_address
    msg['from'] = user
    password = gmail_app_password

    server = smtplib.SMTP("smtp.gmail.com", 587)
    server.starttls()
    server.login(user, password)
    server.send_message(msg)

    server.quit()

if __name__ == '__main__':
    email_alert("HELLO", "DOOR BELL", email_address)