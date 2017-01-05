# Zahlen und Operatoren

Zahlen und Operatoren kennst du aus dem Matheunterricht. Du kannst zahlen addieren, subtrahieren, multiplizieren und dividieren. Für diese Berechnungen gelten in JavaScript die Symbole **+**, **-**, ***** und **/**. Diese nennt man Operatoren. Du hast schon gesehen, dass die Konsole wie ein Taschenrechner funktioniert. Hier sind noch ein paar Beispiele:

```javascript
12345+56789;

1013-25;

123*456;

12345/250;
```

Für Zahlen mit Komma schreibt die Konsole übrigens einen Punkt statt des Kommas, also **49.38** und nicht **49,38**.

Alle Rechenregeln, die du aus der Schule kennst, gelten auch hier, z.B. Punkt vor Strich und was in Klammern steht kommt zuerst.

```javascript
// das ergibt 16 (Punkt vor Strich)
20-8/2;

// aber das ergibt 6 (Klammern zuerst)
(20-8)/2;
```

> **Übung**
>
> Welches Ergebnis hat diese Aufgabe? Rechne zuerst im Kopf oder schriftlich und prüfe dann in der Konsole.

```javascript
((40-10)/5-6*2)/3
```


# Variablen

Du kannst deinen Zahlen auch einen Namen geben. Das nennt man **Variable**. Um eine neue Variable zu erstellen brauchst du Schlüsselwort **var** und den Namen einer Variable. Ein Schlüsselwort ist ein Wort mit einer besonderen Bedeutung in JavScript, es gehört also zur Syntax. Schlüsselwörter dürfen nicht als Name für Variable genutzt werden.

So erstellst du eine neue Variable mit Namen "tina":

```javascript
var tina;
```

Die Konsole gibt darunter **undefined** aus, aber das ist kein Fehler sondern was JavaScript zurückgibt, wenn eine Variable noch keinen Wert hat. Wenn eine Variable einen Wert haben soll, benutzt man das Gleichheitszeichen **=**:

```javascript
var alter = 9;
```

Die Konsole kennt jetzt die Variable __alter__ und sie hat den Wert 9. Du kannst jederzeit wieder ausgeben, welchen Wert sie hat, indem du einfach den Namen der Variable eintippst. Das Schlüsselwort **var** brauchst du hier nicht, da die Variable __alter__ ja schon existiert.

```javascript
alter;
```

Man kann mit Variablen auch rechnen (vielleicht hast du das auch schon im Matheunterricht in der Schule gemacht). Welches Ergebnis erwartest du von dieser Rechnung?

```javascript
var kinder = 1+3;
var ballons = 8;

// Wieviele Ballons kriegt jedes Kind?
ballons / kinder;
```

In der Variable __kinder__ haben wir den Wert 1+3 gespeichert, JavaScript rechnet aus, dass das 4 ergibt. Die Variable __ballons__ hat den Wert 2. In der letzten Zeile haben wir gerechnet __ballons__ geteilt durch __kinder__, also 8 durch 4. Das ergibt 2. Das gibt die Konsole aus.

### Variabblen benennen

Bei der Benennung von Variablen musst du aufpassen, denn JavaScript unterscheidet zwischen Groß- und Kleinschreibung. __Kinder__ ist also nicht das gleiche wie __kinder__. Üblicherweise werden Variablennamen klein geschrieben.

Außerdem dürfen Variablen keine Leerzeichen enthalten, was oft sehr blöd ist, wenn du lange Variablennamen hast. Angenommen du willst das Ergebnis des letzten Beispiels in einer Variable speichern, die "Anzahl Ballons pro Kind" heißen soll. Wenn du die Variable __anzahlballonsprokind__ nennst, kann man das nur schwer lesen. Daher macht man das so: __anzahlBallonsProKind__. Man schreibt also den ersten Buchstaben von jedem Wort groß, außer beim ersten Wort. Das nennen Programmierer "camel case", weil es an die Höcker von einem Kamel erinnert.

```javascript
// ohne camel case
var anzahlballonsprokind = ballons / kinder;

// mit camel case
var anzahlBallonsProKind = ballons / kinder;
```

Jetzt bist du dran.

> **Mission**
>
> Wieviele Sekunden hat der heutige Tag?
>
> Erstelle dafür drei neue Variablen: __sekundenInMinute__ mit dem Wert 60 und __minutenInStunde__ mit dem Wert 60 und __stundenInTag__ mit dem Wert 60. Berechne daraus die Anzahl der Sekunden in einem Tag und speichere den Wert in einer Variable namens __sekundenInTag__. Gib das Ergbenis aus.


Dein Code sollte ungefähr so aussehen:

```javascript
var sekundenInMinute = 60;
var minutenInStunde = 60;
var stundenInTag = 60;
var sekundenInTag = sekundenInMinute * minutenInStunde * stundenInTag;
```

Die letzte Zeile gibt auch das Ergebnis aus:

```
86400
```

## Hoch- und Runterzählen

Beim Programmieren haben wir oft den Fall, dass wir eine Zahl hoch- oder runterzählen müssen. Wir nennen das auch "inkrementieren" (um eins hochzählen) und "dekrementieren" (um eins runterzählen).

## Operatoren ++ und --

Wenn du zählen willst, wieviele Mäuse deine Katze dir gebracht hat, benutzt du **++**:

```javascript
var mäuse = 0;

// eine Maus
++mäuse;

// noch eine Maus
++mäuse;
```

Wenn deine Katze nun eine Maus auffrisst, ziehst du von deinen Mäusen wieder eine ab mit **--**:

```javascript
--mäuse;
```

Du kannst ++ und -- auch hinter die Variable schreiben. Das macht das gleiche, allerdings gibt die Konsole hier zuerst den Wert der Variablen aus und berechnet dann denn neuen Wert. Probiere es aus!

```javascript
mäuse=0;
mäuse++;
mäuse++;
mäuse--;
```

## Operatoren += und -=

Angenommen du hast mehrere Katzen und sie bringen dir gleichzeitig Mäuse. Dann willst du nicht jede Maus einzeln zählen, sondern z.B. gleich 3 Mäuse addieren. Das kannst du so machen:

```javascript
mäuse = 0;
mäuse = mäuse + 3;
```

JavaScript hat den Wert der Variable __mäuse__ genommen, 3 dazu addiert und diesen neuen Wert jetzt in der Variable __mäuse__ gespeichert.

Du kannst das auch abkürzen mit folgender Syntax:

```javascript
mäuse = 0;
mäuse += 3;
```

Das gleiche funktioniert auch mit der Subtraktion:

```javascript
mäuse = 10;
mäuse = mäuse - 4;

// oder in Kurzform
mäuse -= 4;
```

> **Übung**
>
> Was glaubst du passiert bei den folgenden Anweisungen? Probiere aus, ob du richtig liegst.

```javascript
var ballons = 100;
ballons *= 2;

var ballons = 100;
ballons /= 4;
```

# Was du gelernt hast

Du kennst den Datentyp Zahlen und kannst mit den Rechenoperatoren umgehen. Du weißt was Variablen sind. Du kannst eine neue Variable erstellen und ihr einen Wert zuweisen. Du hast gelernt, wie du den Wert einer Variable ändern kannst.
