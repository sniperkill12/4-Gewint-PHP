<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
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
</html>
