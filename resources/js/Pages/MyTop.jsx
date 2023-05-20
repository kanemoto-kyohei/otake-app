import { Link, Head, usePage } from "@inertiajs/react";
import GuestLayout from "@/Layouts/GuestLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import React from "react";

export default function MyTop({ auth }) {

    return (
        <>
            <Head title="Welcome" />
            <GuestLayout>
                <div className="min-h-screen flex items-center justify-center bg-center bg-gray-100  selection:bg-red-500 selection:text-black">
                    <div className="flex flex-col items-center justify-center h-full text-center">
                        <h1 className="text-5xl font-bold">
                            MyCalendarへようこそ
                        </h1>
                        <p className="mt-4 text-lg text-gray-500">
                            このアプリでは、予約カレンダーの生成、生成されたカレンダーから予約をすることができます
                        </p>
                        <div className="mt-4 flex justify-center">
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
                                        <PrimaryButton className="flex-grow">
                                            ログイン
                                        </PrimaryButton>
                                    </Link>

                                    <Link
                                        href={route("register")}
                                        className="ml-4 font-semibold text-gray-600 hover:text-blue-900 dark:text-gray-400 dark:hover:text-blue focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 flex-grow"
                                    >
                                        <PrimaryButton className="flex-grow">
                                            新規登録
                                        </PrimaryButton>
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </GuestLayout>
        </>
    );
}
