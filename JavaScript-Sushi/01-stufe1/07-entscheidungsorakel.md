# Entscheidungsorakel

Du hast schon viel gelernt und bist bereit dein erstes kleines Programm zu schreiben. Für den Anfang soll es ein Entscheidungsorakel werden. Das Orakel hat eine Liste von Antworten und es soll dir zufällig eine ausgeben.
Damit das klappt, müssen wir noch kurz darüber reden wie du Zufallszahlen mit JavaScript erzeugen kann.

## Zufallszahlen

JavaScript hat eine eingebaute Methode **Math.random()** um Zufallszahlen zu erzeugen. Probiere es aus, am besten mehrere Male hintereinander.

```javascript
Math.random();
```

Die Zahlen sind immer zwischen größer gleich 0 und kleiner 1 (genau 1 kommt also nie raus). Da wir die Zufallszahl aber für einen Index brauchen, muss es eine natürliche Zahl sein und sie soll maximal so groß sein wie der letzte Index vom Array des Orakels. Angenommen unser Orakelarray hat die Länge 4, dann ist der letzte Index 3. Die Zufallszahl darf also nur 0, 1, 2 oder 3 sein. Klingt kompliziert aber dafür gibt es einen coolen Mathetrick:

1. Du multiplizierst die Zufallszahl der Länge des Arrays (im Beispiel 4)
2. Du rundest die Zahl mit **Math.floor()** auf die nächste ganze Zahl ab.

Probiere es mit diesem Beispiel aus. Versuche zu verstehen was passiert.

```javascript
var zufallszahl = Math.random();
var großeZufallszahl = 4 * zufallszahl;
var gerundeteZufallszahl = Math.floor(großeZufallszahl);

// jetzt zeigen alle Zahlen an
zufallszahl;
großeZufallszahl;
gerundeteZufallszahl;
```

> **Übung**
>
> Wie kann man das alles in einer Zeile schreiben, ohne Variablen?

Wenn du keine Variablen willst, schreib einfach alles zusammen:

```javascript
Math.floor(Math.random() * 4);
```

# Deine Mission

> **Mission**
>
> Programmiere ein Entscheidungsorakel. Erstelle dafür eine Variable __antworten__, die ein Array mit mehreren Antworten wie z.B. "Gute Idee!" oder "Lass das lieber" enthält. Du kannst soviele Antworten aufzählen wie du willst. Überlege dann wie du in einer Zeile Code eine zufällige Antwort auswählen kannst. Schreibe dein Programm so, dass die zufällige Antwort auch ausgegeben wird, wenn du dem Array neue Elemente hinzufügst.
