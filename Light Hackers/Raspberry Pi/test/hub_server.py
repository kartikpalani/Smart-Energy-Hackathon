import MySQLdb
db = MySQLdb.connect(host='10.129.154.129', user='smart', passwd='smart', db='smartlight')
cur = db.cursor()
cur.execute("CREATE TABLE song ( id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, title TEXT NOT NULL )")

songs = ('Purple Haze', 'All Along the Watch Tower', 'Foxy Lady')
for song in songs:
    cur.execute("INSERT INTO song (title) VALUES (%s)", song)
    print "Auto Increment ID: %s" % cur.lastrowid
	
cur.execute("SELECT * FROM song WHERE id = %s or id = %s", (1,2))

numrows = cur.execute("SELECT * FROM song")
print "Selected %s rows" % numrows      
print "Selected %s rows" % cur.rowcount

# Print results in comma delimited format
# Method 1: Fetch All-at-Once
cur.execute("SELECT * FROM song")
rows = cur.fetchall()
for row in rows:
    for col in row:
        print "%s," % col
    print "\n"
	
# Method 2: Fetch One-at-a-Time
cur.execute("SELECT * FROM song WHERE id = 1")
print "Id: %s -- Title: %s" % cur.fetchone()

cur.execute("commit")

# Get data from database
try:
    cur.execute("SELECT * FROM song")
    rows = cur.fetchall()
except MySQLdb.Error, e:
    try:
        print "MySQL Error [%d]: %s" % (e.args[0], e.args[1])
    except IndexError:
        print "MySQL Error: %s" % str(e)
# Print results in comma delimited format
for row in rows:
    for col in rows:
        print "%s," % col
    print "\n"
	
# Close all cursors
cur.close()
# Close all databases
db.close()