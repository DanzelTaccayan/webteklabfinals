from flask import Flask, render_template, request
from flask_mysqldb import MySQLdb
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)

conn = MySQLdb.connect("localhost","root","","webtekfinals")
cursor = conn.cursor()

@app.route('/')
def index():
	return render_template('dashboard.html')

@app.route('/trial')
def trial():
	username = 'chupa'

	query = "SELECT service_name, created_at, time_needed, service_description from services where service_name = '%s'" %username
	cursor.execute(query)

	data = cursor.fetchall()
	return render_template('index.html', data=data)
	conn.close()



@app.route('/signUp')
def signUp():
	return render_template('signUp.html')


@app.route('/success',methods =	['POST'])
def success():
	firstName = request.form['fname']
	middleName = request.form['mname']
	lastName = request.form['lname']
	address = request.form['address']
	email = request.form['email']
	contactNum = request.form['contactnumber']
	company = request.form['company']


	uname = request.form['uname']
	userPass = request.form['pass']

	userPassHash = generate_password_hash(userPass)
	errors = 0

	try:
		query = "INSERT INTO users (UserName, Password, Status) VALUES ('%s', '%s', 'pending')" %(uname, userPassHash)
		cursor.execute(query)
	
		userId = conn.insert_id()

	except (MySQLdb.Error, MySQLdb.Warning):
		errors = errors +1
		return 'error on user input'

	if errors == 0:
		try:
			query2 = "INSERT INTO user_details (idUser, firstName, middleName, lastName, address, email, contactNumber, company, created_at, updated_at, UserType) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', NOW(), NOW(), 'SP')" %(userId, firstName, middleName, lastName, address, email,contactNum, company )
			cursor.execute(query2)
		except (MySQLdb.Error, MySQLdb.Warning):
			errors = errors + 1


	if errors == 0:
		conn.commit()
		return "Yeah"
	else:
		return "There was an error in requesting your acc"
	
	conn.close()
#addRequest
@app.route('/addReq')
def addReq():


	query = "SELECT * from request"
	cursor.execute(query)

	data = cursor.fetchall()
	return render_template("addReq.html", data=data)

@app.route('/addReqSuccess',methods =['POST'])
def addReqSuccess():
	idReq = request.form['reject']
	errors = 0

	try:

 		query = "DELETE FROM request WHERE idrequest = '%s'" %idReq
 		cursor.execute(query)	
 		userId = conn.insert_id()
 		conn.commit();
 		
 		query = "SELECT * from request"
 		cursor.execute(query)
 		data = cursor.fetchall()
 		return render_template("addReq.html", data=data)
	except (MySQLdb.Error, MySQLdb.Warning):
 		errors = errors +1
 		return 'Request not found'
	cursor.close();	
	conn.close()


#login purposes
@app.route('/login')
def login():
	return render_template('login.html')

@app.route('/loginSuccess')
def loginSuccess():
	username = request.args.get('username')
	userPasswd = request.args.get('password')

	errors = 0

	if errors == 0:
		try:
			query = 'SELECT UserName,Password from users where UserName="%s"' %username
			cursor.execute(query)
			row = cursor.fetchone()
			passwd = row[1]
			if(check_password_hash(passwd,userPasswd)):	
				return render_template('dashboard.html')
			else:
				return "Invalid username or password"

		except (MySQLdb.Error, MySQLdb.Warning):
			errors = errors +1
			return ''

if __name__ == '__main__':
	app.run(host='192.168.56.1', debug=True)
