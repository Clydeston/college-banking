<?php
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION["user_id"])) {
    header("Location: http://localhost/banking%20app/index.php");
    die();
}
?>

<html>

<head>
    <link rel="stylesheet" href="resources/css/style.css" type="text/css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="resources/css/noty.css" type="text/css">
    <link rel="stylesheet" href="resources/css/sunset.css" type="text/css">
</head>

<body>
    <div class="container">
        <div class="row mt-5 mb-5 border p-5 rounded">
            <div class="col-lg-12">
                <h3>Welcome to your profile!</h3>
                <h4>Account Balance: <strong id="overall-balance">£<?php echo $_SESSION["balance"] ?></strong></h4>
                <a class="btn btn-red" id="logout-btn">Logout</a>
            </div>
            <div class="col-lg-12">
                <hr>
                <h3>Account Details</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="<?php echo $_SESSION["email"] ?>" id="email">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" id="current-password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>New Password</label>
                            <input class="form-control" id="new-password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input class="form-control" id="new-password-confirm">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <a class="btn btn-green" id="account-save-btn">Save Changes</a>
                    </div>
                    <div class="col-lg-4">
                        <h4>Deposit Money</h4>
                        <div class="form-group">
                            <label>Account</label>
                            <select class="form-control account-select" id="deposit-account">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input class="form-control" id="deposit-amount">
                        </div>
                        <a class="btn btn-green" id="deposit-btn">Deposit</a>
                    </div>
                    <div class="col-lg-4">
                        <h4>Withdraw Money</h4>
                        <div class="form-group">
                            <label>Account</label>
                            <select class="form-control account-select" id="withdraw-account">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input class="form-control" id="withdraw-amount">
                        </div>
                        <a class="btn btn-green" id="withdraw-btn">Withdraw</a>
                    </div>
                    <div class="col-lg-4">
                        <h4>Transfer Money</h4>
                        <div class="form-group">
                            <label>Account</label>
                            <select class="form-control account-select" id="transfer-account">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ID / Email</label>
                            <input class="form-control" id="recipient-id">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input class="form-control" id="transfer-amount">
                        </div>
                        <a class="btn btn-green" id="transfer-btn">Transfer</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <h4>New Account</h4>
                        <div class="form-group">
                            <select class="form-control" id="account-type">
                                <option value="2">Saver Account</option>
                                <option value="3">Cash ISA</option>
                            </select>
                        </div>
                        <a class="btn btn-green" id="create-account">Create Account</a>
                    </div>
                </div>
                <h3>Accounts</h3>
                <div class="row" id="accounts-row">
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="account-delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-red" id="delete-account-btn" data-id="">Delete</button>
                    <button type="button" class="btn btn-green" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="account-transfer-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfer Account Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Account To Deposit</label>
                        <select id="transfer-account-select" class="account-select form-control"></select>
                    </div>
                    <div class="form-group">
                        <label>Transfer Amount</label>
                        <input class="form-control" id="transfer-balance">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-green" id="transfer-account-btn" data-id="">Transfer</button>
                    <button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="resources/scripts/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="resources/scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="resources/scripts/scripts.js"></script>
    <script type="text/javascript" src="resources/scripts/popper.min.js"></script>
    <script type="text/javascript" src="resources/scripts/noty.js"></script>
    <script>
        $("#logout-btn").click(function() {
            $.ajax({
                url: 'backend/logout.php',
                type: 'GET',
                cache: false,
                success: function(data) {
                    location.href = "index.php";
                },
                error: function(data) {
                    location.reload();
                }
            });

        });

        $("#withdraw-btn").click(function() {
            var withdraw_amount = $("#withdraw-amount").val();
            var withdraw_account = $("#withdraw-account").val();

            if (!withdraw_amount || !withdraw_account) {
                genError("Please ensure all fields are populated!");
                return false;
            }

            if (withdraw_amount > 50000) {
                genError("Only £50,000 can be withdrawn at a time!");
                return false;
            }

            $.ajax({
                url: 'backend/banking/withdraw.php',
                type: 'POST',
                data: {
                    withdraw_amount: withdraw_amount,
                    withdraw_account: withdraw_account
                },
                cache: false,
                success: function(data) {
                    updateBalance();
                    genSuccess(data);
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });

        });

        $("#deposit-btn").click(function() {
            var deposit_amount = $("#deposit-amount").val();
            var deposit_account = $("#deposit-account").val();

            if (!deposit_amount) {
                genError("Please ensure all fields are populated!");
                return false;
            }

            if (deposit_amount > 50000) {
                genError("Only £50,000 can be deposited at a time!");
                return false;
            }

            $.ajax({
                url: 'backend/banking/deposit.php',
                type: 'POST',
                data: {
                    deposit_amount: deposit_amount,
                    deposit_account: deposit_account
                },
                cache: false,
                success: function(data) {
                    updateBalance();
                    genSuccess(data);
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });

        });

        $("#transfer-btn").click(function() {
            var transfer_amount = $("#transfer-amount").val();
            var recipient_id = $("#recipient-id").val();
            var transfer_account = $("#transfer-account").val();

            if (!transfer_amount || !recipient_id) {
                genError("Please ensure all fields are populated!");
                return false;
            }

            if (transfer_amount > 50000) {
                genError("Only £50,000 can be transferred at a time!");
                return false;
            }

            $.ajax({
                url: 'backend/banking/transfer.php',
                type: 'POST',
                data: {
                    transfer_amount: transfer_amount,
                    transfer_account: transfer_account,
                    recipient_id: recipient_id
                },
                cache: false,
                success: function(data) {
                    updateBalance();
                    genSuccess(data);
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });

        });

        $("#account-save-btn").click(function() {
            var email = $("#email").val();
            var password = $("#current-password").val();
            var new_password = $("#new-password").val();
            var confirm_password = $("#new-password-confirm").val();

            if (!email && !password && !confirm_password && !new_password) {
                genError("Please ensure all fields are populated!");
                return false;
            }

            if (!password) {
                genError("Please enter your password to update any details!");
                return false;
            }

            if (email == "<?php echo $_SESSION["email"] ?>" && !new_password) {
                genError("Please enter a new email!");
                return false;
            }

            if (confirm_password != new_password) {
                genError("Please ensure the new passwords match!");
                return false;
            }

            $.ajax({
                url: 'backend/update_details.php',
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    confirm_password: confirm_password,
                    new_password: new_password
                },
                cache: false,
                success: function(data) {
                    updateBalance();
                    genSuccess(data);
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });
        });

        $(document).on("click", ".account-delete", function() {
            $("#delete-account-btn").attr("data-id", $(this).attr("data-id"));
            $("#account-delete-modal").modal("toggle");
        });

        $("#delete-account-btn").click(function() {
            var account_id = $(this).attr("data-id");

            if (!account_id) {
                genError("Please provide a valid account ID!");
                return false;
            }

            $.ajax({
                url: 'backend/banking/accounts/delete.php',
                type: 'POST',
                data: {
                    account_id: account_id
                },
                cache: false,
                success: function(data) {
                    updateBalance();
                    genSuccess(data);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);    
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });
        });

        $(document).on("click", ".account-transfer", function() {
            $("#transfer-account-btn").attr("data-id", $(this).attr("data-id"));
            $("#account-transfer-modal").modal("toggle");
            $('option:hidden').each(function() {
                $(this).show();
            });
            $("#transfer-account-select option[value=" + $(this).attr("data-id") + "]").hide();
            $('#transfer-account-select option').each(function() {
                if ($(this).css('display') != 'none') {
                    $(this).prop("selected", true);
                    return false;
                }
            });            
        });

        $("#transfer-account-btn").click(function() {
            var account_id = $(this).attr("data-id");
            var account_deposit_id = $("#transfer-account-select").val();
            var transfer_amount = $("#transfer-balance").val();

            if (!account_id) {
                genError("Please provide a valid account ID!");
                return false;
            }

            $.ajax({
                url: 'backend/banking/accounts/transfer.php',
                type: 'POST',
                data: {
                    account_id: account_id,
                    account_deposit_id: account_deposit_id,
                    transfer_amount: transfer_amount
                },
                cache: false,
                success: function(data) {
                    updateBalance();
                    genSuccess(data);
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });
        });
        
        $("#create-account").click(function() {
            var account_type = $("#account-type").val();

            if (!account_type) {
                genError("Please provide a valid account type!");
                return false;
            }

            $.ajax({
                url: 'backend/banking/accounts/create.php',
                type: 'POST',
                data: {
                    account_type: account_type
                },
                cache: false,
                success: function(data) {
                    genSuccess(data);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);                    
                },
                error: function(data) {
                    genError(data.responseText);
                }
            });
        });

        function updateBalance() {
            $.ajax({
                url: 'backend/banking/balance.php',
                type: 'GET',
                cache: false,
                success: function(data) {
                    var balance = data.split(";")[0];
                    var account_balances = data.split(";")[1];
                    $("#overall-balance").text(`£${balance.trim()}`);

                    var accounts_balances_array = account_balances.split("|");
                    for (var i = 0; i < accounts_balances_array.length; i++) {
                        var account_id = accounts_balances_array[i].split(":")[0];
                        var account_balance = accounts_balances_array[i].split(":")[1];

                        $(`[data-account='${account_id}']`).text(`Balance: £${account_balance}`);

                    }
                },
                error: function(data) {
                    location.reload();
                }
            });
        }

        // fetching account information
        $.ajax({
            url: 'backend/banking/accounts/accounts.php',
            type: 'GET',
            cache: false,
            success: function(data) {
                var json_obj = JSON.parse(data);
                for (var i = 0; i < json_obj.length; i++) {
                    var balance = json_obj[i].balance;
                    var id = json_obj[i].id;
                    var type = json_obj[i].type;
                    var text_type;
                    switch (type) {
                        case "1":
                            text_type = "Current Account";
                            break;
                        case "2":
                            text_type = "Saver Account: #" + id;
                            break;
                        case "3":
                            text_type = "ISA Account: #" + id;
                            break;
                    }

                    $(".account-select").append(`<option value="${id}">${text_type}</option>`)
                    $("#accounts-row").append(`<div class="col-lg-3 mr-2 mt-1 p-3 rounded alert-info">` +
                        `<h5>${text_type}</h5>` + `<h6 data-account="${id}">Balance: £${balance}</h6>` +
                        `<a class="account-anchor account-delete delete mr-2" data-id="${id}">Delete</a>` +
                        `<a class="account-anchor account-transfer" data-id="${id}">Transfer</a>` + `</div>`)
                }
            },
            error: function(data) {
                alert("Error fetching account info.");
            }
        });
    </script>
</body>

</html>