<form action="db-action.php" method="POST">
    <div class="installationForm">
        <table class="table">
            <tbody>
                <tr class="tableRow">
                    <td class="table-col-4 table-label">
                        <strong>Database Name</strong>
                    </td>
                    <td class="table-col-6">
                        <input type="text" class="installInput" name="dbname" placeholder="test">
                    </td>
                </tr>
                <tr class="tableRow">
                    <td class="table-col-4 table-label">
                        <strong>Database User Name</strong>
                    </td>
                    <td class="table-col-6">
                        <input type="text" class="installInput" name="dblogin" placeholder="root">
                    </td>
                </tr>
                <tr class="tableRow">
                    <td class="table-col-4 table-label">
                        <strong>Database User Password</strong>
                    </td>
                    <td class="table-col-6">
                        <input type="text" class="installInput" name="dbpassword" placeholder="">
                    </td>
                </tr>
                <tr class="tableRow">
                    <td class="table-col-4 table-label">
                        <strong>Database Server Address</strong>
                    </td>
                    <td class="table-col-6">
                        <input type="text" class="installInput" name="dbserver" placeholder="localhost">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="installationButton">
        <button class="button" type="dbsubmit">Install</button>
    </div>
</form>
