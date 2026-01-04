<?php
$data = mysqli_connect("localhost", "root", "", "hr_systems");
$result = mysqli_query($data, "SELECT * FROM job_applications_raw ORDER BY applied_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #16dbd1ff;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:hover {
            background: #f0f9f9;
        }

        a {
            color: #16dbd1ff;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media(max-width:600px) {

            th,
            td {
                padding: 8px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <h1>Applicant List</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Applied Position</th>
                <th>Applied Date</th>
                <th>Cover Letter</th>
                <th>CV</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) {
                $file_path = "../upload/" . $row['uploadresume']; // correct path
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['fname']) ?></td>
                    <td><?= htmlspecialchars($row['lname']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['appliedPosition']) ?></td>
                    <td><?= htmlspecialchars($row['applied_date']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['coverletter'])) ?></td>
                    <td>
                        <?php if (file_exists($file_path)) { ?>
                            <a href="<?= htmlspecialchars($file_path) ?>" target="_blank">View CV</a>
                        <?php } else { ?>
                            File not found
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>

</html>