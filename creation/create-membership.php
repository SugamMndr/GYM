<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership</title>
</head>

<body>
    <form action="">
        <fieldset>
            <legend>Member Info</legend><br>

            <div><label for="Member id">Member_ID</label>
                <input type="number" id="number" name="number" required>
            </div><br>
            <div>
                <label>Member name</label>
                <input type=" text" required>

            </div><br>
            <summary>Membership type</summary>
            <select name="" id="">
                <option value="Silver">Silver - Rs1500/Month</option>
                <option value="Gold">Gold - Rs2500/Month</option>
                <option value="Silver">Platinum - Rs3500/Month</option>
            </select>
           
            <label for="start-date">Start-date</label>
            <input type="date" id="start-date" name="start-date" required><br><br>
            <label for="end-date">End-date</label>
            <input type="date" id="end-date" name="end-date" required><br><br>
            <button type="submit">
            Submit
        </button>
        </fieldset>


</body>

</html>