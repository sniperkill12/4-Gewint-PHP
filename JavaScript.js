/* Definiert die Anzahl der Reihen und Spalten */
const rows = 6;
const cols = 7;
/* Setzt den aktuellen Spieler auf 'red' */
let currentPlayer = 'red';
/* Erstellt ein 6x7 Spielfeld als Array, das am Anfang mit 'null' gefüllt ist */
const board = Array.from({ length: rows }, () => Array(cols).fill(null));

/* Erstellt die visuelle Darstellung des Spielfelds als HTML-Tabelle */
function createBoard() {
    const table = document.getElementById('gameBoard');
    for (let r = 0; r < rows; r++) {  /* Für jede Zeile */
        const row = document.createElement('tr'); /* Erstelle eine neue Tabellenzeile */
        for (let c = 0; c < cols; c++) {  /* Für jede Spalte */
            const cell = document.createElement('td'); /* Erstelle eine neue Zelle */
            /* Füge einen Klick-Event-Listener für jede Zelle hinzu */
            cell.addEventListener('click', () => handleCellClick(c));
            row.appendChild(cell); /* Füge die Zelle der Zeile hinzu */
        }
        table.appendChild(row); /* Füge die Zeile dem Spielfeld (Tabelle) hinzu */
    }
}

/* Funktion, die aufgerufen wird, wenn ein Spieler eine Spalte anklickt */
function handleCellClick(col) {
    /* Durchlaufe die Zeilen von unten nach oben */
    for (let r = rows - 1; r >= 0; r--) {
        /* Finde die erste leere Zelle in der Spalte */
        if (!board[r][col]) {
            board[r][col] = currentPlayer; /* Belege die Zelle mit dem aktuellen Spieler */
            /* Suche die entsprechende Zelle im DOM */
            const cell = document.querySelector(`tr:nth-child(${r + 1}) td:nth-child(${col + 1})`);
            const ball = document.createElement('div'); /* Erstelle das Ball-Element */
            ball.classList.add('ball'); /* Füge die 'ball'-Klasse hinzu */
            cell.classList.add(currentPlayer); /* Setze die Farbe der Zelle (rot oder gelb) */
            cell.appendChild(ball); /* Füge das Ball-Element in die Zelle ein */
            /* Überprüfe, ob der aktuelle Spieler gewonnen hat */
            if (checkWin(r, col)) {
                /* Zeige eine Nachricht an, wenn der Spieler gewonnen hat */
                setTimeout(() => alert(currentPlayer + ' gewinnt!'), 10);
            }
            /* Wechsle den Spieler */
            currentPlayer = currentPlayer === 'red' ? 'yellow' : 'red';
            break;
        }
    }
}

/* Überprüft, ob der aktuelle Spieler gewonnen hat */
function checkWin(row, col) {
    return (
        checkDirection(row, col, 1, 0) || // Horizontal prüfen
        checkDirection(row, col, 0, 1) || // Vertikal prüfen
        checkDirection(row, col, 1, 1) || // Diagonal nach rechts unten prüfen
        checkDirection(row, col, 1, -1)   // Diagonal nach links unten prüfen
    );
}

/* Überprüft eine bestimmte Richtung (horizontal, vertikal, diagonal) auf vier aufeinanderfolgende Steine */
function checkDirection(row, col, rowIncrement, colIncrement) {
    let count = 0;  /* Zählt die Anzahl der aufeinanderfolgenden Steine */
    let player = board[row][col];  /* Aktueller Spieler */

    /* Prüfe die 3 Felder in beide Richtungen */
    for (let i = -3; i <= 3; i++) {
        const r = row + i * rowIncrement; /* Zeilenverschiebung */
        const c = col + i * colIncrement; /* Spaltenverschiebung */
        /* Stelle sicher, dass die überprüfte Zelle innerhalb des Spielfeldes liegt und dem Spieler gehört */
        if (r >= 0 && r < rows && c >= 0 && c < cols && board[r][c] === player) {
            count++;  /* Erhöhe den Zähler, wenn der Spielerstein gefunden wird */
            if (count === 4) return true;  /* Wenn 4 Steine in Folge gefunden wurden, gewinnt der Spieler */
        } else {
            count = 0;  /* Setze den Zähler zurück, wenn die Kette unterbrochen wird */
        }
    }
    return false;  /* Kein Gewinn in dieser Richtung */
}

/* Initialisiere das Spielbrett */
createBoard();
