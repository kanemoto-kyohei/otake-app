import { Link, Head, usePage } from "@inertiajs/react";
import ApplicationLogo2 from "@/Components/ApplicationLogo2";
import CustomLayout from "@/Layouts/CustomLayout";
import React from "react";
import { Button } from "@mui/material";

export default function MyTop({ auth }) {
    return (
        <>
            <Head title="Welcome" />
            <CustomLayout>
                <div className="flex flex-col items-center justify-center text-center space-y-8">
                    <div className="flex items-center justify-center">
                        <Link>
                            <div className="bg-white rounded-full p-2">
                                <ApplicationLogo2 className="w-12 h-12 fill-current text-gray-500" />
                            </div>
                        </Link>
                    </div>

                    <h1 className="text-5xl font-bold">MyCalendar</h1>
                    <p className="mt-4 text-lg text-gray-500">
                        自分だけのカレンダー<br></br>予約をスマートに管理
                    </p>

                    <div className="flex justify-center">
                        {auth.user ? (
                            <Link
                                href={route("dashboard")}
                                className="font-semibold text-gray-600 hover:text-blue-900 dark:text-gray-400 dark:hover:text-blue focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >
                                ダッシュボード
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route("login")}
                                    className="font-semibold text-gray-600 hover:text-blue-900 dark:text-gray-400 dark:hover:text-blue focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 flex-grow"
                                >
                                    <Button className="flex-grow">
                                        ログイン
                                    </Button>
                                </Link>

                                <Link
                                    href={route("register")}
                                    className="ml-4 font-semibold text-gray-600 hover:text-blue-900 dark:text-gray-400 dark:hover:text-blue focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 flex-grow"
                                >
                                    <Button className="flex-grow">
                                        新規登録
                                    </Button>
                                </Link>
                            </>
                        )}
                    </div>
                </div>
            </CustomLayout>
        </>
    );
}
