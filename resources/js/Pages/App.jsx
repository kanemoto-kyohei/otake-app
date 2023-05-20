import { usePage } from "@inertiajs/react";
import CalendarTitle from "@/Pages/CalendarTitle";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import CalendarTable from "@/Pages/CalendarTable";
import AppoDisplay from "@/Pages/AppoDisplay";
import React from "react";

const App = () => {
    const { carender_elements, auth, appointments, userId, flash } =
        usePage().props;
    return (
        <AuthenticatedLayout user={auth.user}>
            <CalendarTitle carender_elements={carender_elements} />

            <CalendarTable
                carender_elements={carender_elements}
            ></CalendarTable>
            {flash.error && (
                <div className="text-center">
                    <div style={{ color: "red" }}>{flash.error}</div>
                </div>
            )}

            <AppoDisplay appointments={appointments} userId={userId} />
        </AuthenticatedLayout>
    );
};
export default App;
