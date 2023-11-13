<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
    <style>
        .container--tabs {
            margin: 2rem;

            .nav-tabs {
                float: left;
                width: 100%;
                margin: 0;
                list-style-type: none;
                border-bottom: 1px solid #ddd;

                >li {
                    float: left;
                    margin-bottom: -1px;

                    >a {
                        float: left;
                        margin-right: 2px;
                        line-height: 1.42857143;
                        padding: 10px;
                        border: 1px solid transparent;
                        border-radius: 4px 4px 0 0;

                        &:hover {
                            border-color: #eee #eee #ddd;
                        }
                    }

                    &.active {

                        >a,
                        >a:hover,
                        >a:focus {
                            color: #555;
                            cursor: default;
                            background-color: #fff;
                            border: 1px solid #ddd;
                            border-bottom-color: transparent;
                        }
                    }
                }
            }

            .tab-content {
                float: left;
                width: 100%;

                >.tab-pane {
                    display: none;

                    &.active {
                        display: block;
                        padding: 2.5% 3.5%;
                        background-color: #efefef;
                    }
                }

                >.active {
                    display: block;
                }
            }

        }
    </style>

</head>

<body class="antialiased">
    <div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply"
            alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
        <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl"
            aria-hidden="true">
            <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu"
            aria-hidden="true">
            <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Create a Task</h2>
                <p class="mt-6 text-lg leading-8 text-gray-300">You can Login and Create a Task</p>
            </div>
        </div>
    </div>



    <div class="container--tabs">
        <section class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1">Login</a></li>
                <li class=""><a href="#tab-2">Create Task</a></li>
            </ul>
            <div class="tab-content flex justify-center">

                <div id="tab-1" class="tab-pane active">
                    <span class="glyphicon glyphicon-leaf glyphicon--home--feature two columns text-center"></span>
                    <section class="bg-gray-50 dark:bg-gray-900">
                        <div
                            class="relative sm:flex sm:justify-center sm:items-start min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

                            <div
                                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <h1
                                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                        Log in to your account
                                    </h1>
                                    <form class="space-y-4 md:space-y-6" action="#">
                                        <div>
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                                email</label>
                                            <input type="email" name="email" id="email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@company.com" required="">
                                        </div>
                                        <div>
                                            <label for="password"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                            <input type="password" name="password" id="password" placeholder="••••••••"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required="">
                                        </div>
                                        <button onclick="getToken()" type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Sign in
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div id="tab-2" class="tab-pane">
                    <span class="glyphicon glyphicon-fire glyphicon--home--feature two columns text-center"></span>
                    <section class="bg-gray-50 dark:bg-gray-900">
                        <div
                            class="relative sm:flex sm:justify-center sm:items-start min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

                            <div
                                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <h1
                                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                        Create a Task
                                    </h1>
                                    <form class="space-y-4 md:space-y-6" action="#">
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                for="Title">
                                                Title
                                            </label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="title" type="text" name="title" placeholder="title">
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                for="content">
                                                Content
                                            </label>
                                            <textarea
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                id="content" name="content" rows="3"></textarea>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                type="button" onclick="createItem()">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>

    <p class="text-center text-gray-500 text-xs">
        &copy;2023 Acme Corp. All rights reserved.
    </p>
</body>

<script>
    // make the request to the login endpoint
    function getToken() {
        var loginUrl = "http://localhost/api/auth/login"
        var xhr = new XMLHttpRequest();
        var emailElement = document.getElementById('email');
        var passwordElement = document.getElementById('password');
        var tokenElement = document.getElementById('token');
        var email = emailElement.value;
        var password = passwordElement.value;

        xhr.open('POST', loginUrl, true);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        xhr.addEventListener('load', function() {
            var responseObject = JSON.parse(this.response);
            console.log(responseObject);
            if (responseObject.authorisation.token) {
                localStorage.setItem('token', responseObject.authorisation.token);

            } else {
                tokenElement.innerHTML = "No token received";
            }
        });

        var sendObject = JSON.stringify({
            email: email,
            password: password
        });

        console.log('going to send', sendObject);

        xhr.send(sendObject);
    }
</script>

<script>
    // make the request to the login endpoint
    function createItem() {
        var url = "http://localhost/api/v1/tasks"
        var xhr = new XMLHttpRequest();
        var titleElement = document.getElementById('title');
        var contentElement = document.getElementById('content');
        var tokenElement = localStorage.getItem('token');
        var title = titleElement.value;
        var content = contentElement.value;

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        xhr.setRequestHeader("Authorization", "Bearer " + tokenElement);

        xhr.addEventListener('load', function() {
            var responseObject = JSON.parse(this.response);
            console.log(responseObject);
        });

        var sendObject = JSON.stringify({
            title: title,
            content: content,
            status: "pending"
        });

        console.log('going to save', sendObject);

        xhr.send(sendObject);
    }
</script>

<script>
    window.addEventListener("load", function() {
        // store tabs variable
        var myTabs = document.querySelectorAll("ul.nav-tabs > li");

        function myTabClicks(tabClickEvent) {
            for (var i = 0; i < myTabs.length; i++) {
                myTabs[i].classList.remove("active");
            }
            var clickedTab = tabClickEvent.currentTarget;
            clickedTab.classList.add("active");
            tabClickEvent.preventDefault();
            var myContentPanes = document.querySelectorAll(".tab-pane");
            for (i = 0; i < myContentPanes.length; i++) {
                myContentPanes[i].classList.remove("active");
            }
            var anchorReference = tabClickEvent.target;
            var activePaneId = anchorReference.getAttribute("href");
            var activePane = document.querySelector(activePaneId);
            activePane.classList.add("active");
        }
        for (i = 0; i < myTabs.length; i++) {
            myTabs[i].addEventListener("click", myTabClicks)
        }
    });
</script>

</html>
