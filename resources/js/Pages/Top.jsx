import { usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from "@inertiajs/react";
import React from "react";

export default function Top() {
    const { auth, flash } = usePage().props;

    return (
        <AuthenticatedLayout user={auth.user}>
            <div className="text-center">
                <Link href="admins">
                    <h1 className="text-center mt-5">
                        いずれかを選択してください
                    </h1>
                    {flash.link && (
                        <div className="text-center">
                            <div style={{ color: "red" }}>{flash.link}</div>
                        </div>
                    )}
                    <PrimaryButton className="mt-4 mr-5">
                        管理者として続ける
                    </PrimaryButton>
                </Link>
                <Link href="users">
                    <PrimaryButton className="mt-4">
                        一般ユーザとして続ける
                    </PrimaryButton>
                </Link>
            </div>
        </AuthenticatedLayout>
    );
}
