<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 Gewinnt</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        table {
            border-collapse: collapse;
        }
        td {
            width: 50px;
            height: 50px;
            position: relative;
            border: 1px solid #333;
            cursor: pointer;
            background-color: #f4f4f4;
        }
        .ball {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: 5px;
            transition: background-color 0.3s;
            border: 2px solid black; /* Schwarzer Rand */
        }
        .red .ball {
            background-color: red;
        }
        .yellow .ball {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <table id="gameBoard"></table>
    <script>
        const rows = 6;
        const cols = 7;
        let currentPlayer = 'red';
        const board = Array.from({ length: rows }, () => Array(cols).fill(null));

        function createBoard() {
            const table = document.getElementById('gameBoard');
            for (let r = 0; r < rows; r++) {
                const row = document.createElement('tr');
                for (let c = 0; c < cols; c++) {
                    const cell = document.createElement('td');
                    cell.addEventListener('click', () => handleCellClick(c));
                    row.appendChild(cell);
                }
                table.appendChild(row);
            }
        }

        function handleCellClick(col) {
            for (let r = rows - 1; r >= 0; r--) {
                if (!board[r][col]) {
                    board[r][col] = currentPlayer;
                    const cell = document.querySelector(`tr:nth-child(${r + 1}) td:nth-child(${col + 1})`);
                    const ball = document.createElement('div');
                    ball.classList.add('ball');
                    cell.classList.add(currentPlayer);
                    cell.appendChild(ball);
                    if (checkWin(r, col)) {
                        setTimeout(() => alert(currentPlayer + ' gewinnt!'), 10);
                    }
                    currentPlayer = currentPlayer === 'red' ? 'yellow' : 'red';
                    break;
                }
            }
        }

        function checkWin(row, col) {
            return (
                checkDirection(row, col, 1, 0) || // horizontal
                checkDirection(row, col, 0, 1) || // vertical
                checkDirection(row, col, 1, 1) || // diagonal down-right
                checkDirection(row, col, 1, -1)   // diagonal down-left
            );
        }

        function checkDirection(row, col, rowIncrement, colIncrement) {
            let count = 0;
            let player = board[row][col];

            for (let i = -3; i <= 3; i++) {
                const r = row + i * rowIncrement;
                const c = col + i * colIncrement;
                if (r >= 0 && r < rows && c >= 0 && c < cols && board[r][c] === player) {
                    count++;
                    if (count === 4) return true;
                } else {
                    count = 0;
                }
            }
            return false;
        }

        createBoard();
    </script>
</body>
</html>



<!-- <!DOCTYPE html>
<html>
<head>
    <title>Connect Four</title>
    <style>
        #board {
            display: grid;
            grid-template-columns: repeat(7, 60px);
            grid-gap: 5px;
            margin: 20px auto;
            width: 455px;
        }
        .cell {
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .cell.red {
            background-color: red;
        }
        .cell.yellow {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p><a href="logout.php">Logout</a></p>
    <p id="turn">Player 1's turn (Red)</p>
    <div id="board"></div>
    <script>
        const rows = 6;
        const cols = 7;
        let board = [];
        let currentPlayer = 1;
        const boardDiv = document.getElementById('board');
        const turnIndicator = document.getElementById('turn');

        function initializeBoard() {
            board = [];
            for (let r = 0; r < rows; r++) {
                board[r] = [];
                for (let c = 0; c < cols; c++) {
                    board[r][c] = 0;
                }
            }
        }

        function renderBoard() {
            boardDiv.innerHTML = '';
            for (let r = 0; r < rows; r++) {
                for (let c = 0; c < cols; c++) {
                    const cell = document.createElement('div');
                    cell.classList.add('cell');
                    cell.dataset.row = r;
                    cell.dataset.col = c;
                    if (board[r][c] === 1) {
                        cell.classList.add('red');
                    } else if (board[r][c] === 2) {
                        cell.classList.add('yellow');
                    }
                    cell.addEventListener('click', handleCellClick);
                    boardDiv.appendChild(cell);
                }
            }
        }

        function handleCellClick(event) {
            const col = parseInt(event.target.dataset.col);
            for (let r = rows - 1; r >= 0; r--) {
                if (board[r][col] === 0) {
                    board[r][col] = currentPlayer;
                    renderBoard();
                    if (checkWin(r, col)) {
                        alert('Player ' + currentPlayer + ' wins!');
                        initializeBoard();
                        renderBoard();
                    } else {
                        currentPlayer = currentPlayer === 1 ? 2 : 1;
                        turnIndicator.textContent = `Player ${currentPlayer}'s turn (${currentPlayer === 1 ? 'Red' : 'Yellow'})`;
                    }
                    break;
                }
            }
        }

        function checkWin(row, col) {
            // Check directions: horizontal, vertical, diagonal (\), diagonal (/)
            return checkDirection(row, col, 0, 1) || // Horizontal
                   checkDirection(row, col, 1, 0) || // Vertical
                   checkDirection(row, col, 1, 1) || // Diagonal \
                   checkDirection(row, col, 1, -1);  // Diagonal /
        }

        function checkDirection(row, col, rowDir, colDir) {
            let count = 1;
            count += countInDirection(row, col, rowDir, colDir);
            count += countInDirection(row, col, -rowDir, -colDir);
            return count >= 4;
        }

        function countInDirection(row, col, rowDir, colDir) {
            let r = row + rowDir;
            let c = col + colDir;
            let count = 0;
            while (r >= 0 && r < rows && c >= 0 && c < cols && board[r][c] === currentPlayer) {
                count++;
                r += rowDir;
                c += colDir;
            }
            return count;
        }

        initializeBoard();
        renderBoard();
    </script>
</body>
</html> -->
