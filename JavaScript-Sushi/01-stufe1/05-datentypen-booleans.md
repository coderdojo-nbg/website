# Booleans

Ein Boolean (Bool'scher Wert) ist einfach ein Wert der entweder **wahr** (true) oder **falsch** (false) sein kann.
Du kannst jeder Variable ein Booelean zuweisen.

```javascript
var javascriptIstToll = true;
javascriptIstToll;
```

Wir werden Booleans zunächst nur benutzen um Dinge zu vergleichen und damit Entscheidungen zu fällen. Später werden wir auch **logische Operatoren** betrachten. Damit kann man noch viel coole Dinge tun.

wir können bestimmte Zeichen benutzen um JavaScript fragen zu stellen. Zum Beispiel so:

```javascript
var zwei = 2;
var fünf = 5;

// das gibt false zurück
zwei === fünf;
```

Im Beispiel haben wir **===** benutzt, um zu fragen: "Ist zwei das Gleiche wie fünf?" JavaScript nimmt dann die Werte dieser Variablen, also 2 und 5, vergleicht sie und gibt als Antwort entweder **true** (ja) oder **false** (nein). Da 2 und 5 nicht gleich sind, bekommen wir hier die Antwort **false**.

Wir könnten auch fragen: "Sind zwei und fünf ungleich?" Dann wäre die Antwort **true**. Dafür benutzen wir **!==**.

```javascript
zwei !== fünf
```

Außerdem gibt es noch folgende Möglichkeiten (das kennst du aus Mathe):

```javascript
// Ist zwei größer fünf?
zwei > fünf;

// Ist zwei größer oder gleich fünf?
zwei >= fünf;

// Ist zwei kleiner fünf?
zwei < fünf;

// Ist zwei kleiner oder gleich fünf?
zwei <= fünf
```

Du kannst auch Strings miteinander vergleichen. Was glaubst du kommt bei folgendem Code raus?

```javascript
"string" === "string";
"string" === "String";
```

Im ersten Fall kommt **true** raus, im zweiten Fall **false**, da JavaScript zwischen Groß- und Kleinschreibung unterscheidet.

Ebenso kannst Zahlen mit Strings vergleichen, das ergibt **false**.

```javascript
"string" === 32;
"1" === 1;
```

Genauso gut kannst du zwei Booleans vergleichen:

```javascript
true === true;
true === false;
true !== false;
```

## Wenn du mal "nichts" sagen willst

In JavaScript gibt es mehrere Möglichkeiten den Wert "nichts" auszudrücken. Eine davon kennst du schon. Es ist **undefined**. Eine Variable ist immer dann **undefined** wenn JavaScript keinen Wert dafür kennt. Wenn du bewusst ausdrücken willst, dass eine Variable keinen Wert hat, benutze besser **null**. Dann ist auf jeden Fall klar, dass du sagen willst "Hier ist nichts".

```javascript
// diese Variable ist undefined, weil ihr kein Wert zugewiesen ist
var x;

// diese Variable hat den Wert null
var y = null;
```

# Was du gelernt hast

Du weißt was Booleans sind und kannst Dinge miteinander vergleichen. Du weißt wie du in JavaScript "nichts" ausdrücken kannst.
