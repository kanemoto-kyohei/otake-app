import { usePage, useForm } from "@inertiajs/react";
import CalendarTitle from "@/Pages/CalendarTitle";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import AdminCalendar from "@/Pages/AdminCalendar";
import PrimaryButton from "@/Components/PrimaryButton";
import React from "react";

const AdminApp = () => {
    const { carender_elements, auth } = usePage().props;
    const { post } = useForm();

    function submit(e) {
        e.preventDefault();
        post(route("admin.inertiaReset"));
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <CalendarTitle carender_elements={carender_elements} />
            <AdminCalendar
                carender_elements={carender_elements}
            ></AdminCalendar>
            <form onSubmit={submit}>
                <div className="mt-5 flex flex-col items-center">
                    <PrimaryButton
                        href={route("admin.inertiaReset")}
                        className="mt-5"
                        style={{
                            marginRight: "25rem",
                            textDecoration: "underline",
                        }}
                    >
                        カレンダーの設定を変更する
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticatedLayout>
    );
};
export default AdminApp;
