from flask import Flask, request, render_template, redirect
import mysql.connector

app = Flask(__name__)
app.config["SECRET_KEY"] = "secret"

mysql = mysql.connector.connect(
                  host="localhost",
                  user="root",
                  password="",
                  database="secte")

@app.route('/', methods = ["GET", "POST"]) #
def recup():
    if request.method =="POST":
        CouleurDeLaura = request.form.get("couleur")
        nom = request.form.get("titre")
        prenom = request.form.get("titree")
        Groupesanguin = request.form.get("groupe")
        Qualitedelavibrationcellulaire = request.form.get("qualite")
        vaccine = request.form.get("vaccinated")
        if vaccine == "on" or vaccine == True :
            vaccine = 1
        else:
            vaccine = 0
        Tailledelaura = request.form.get("taille")
        Placehiérarchique = request.form.get("place")
        date = request.form.get("date")

        cursor = mysql.cursor()
        cursor.execute("INSERT INTO `secte` (`couleur`, `groupe`, `qualite`, `vaccinated`, `taille`, `place`, `date`, `nom`, `prenom`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", (CouleurDeLaura, Groupesanguin, Qualitedelavibrationcellulaire, vaccine, Tailledelaura, Placehiérarchique, date, nom, prenom))
        mysql.commit()


    return render_template('index.html')


if __name__ == '__main__':
    app.run()



