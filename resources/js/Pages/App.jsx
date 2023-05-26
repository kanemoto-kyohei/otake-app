import { usePage } from "@inertiajs/react";
import CalendarTitle from "@/Pages/CalendarTitle";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import CalendarTable from "@/Pages/CalendarTable";
import UserConfirmForm from "@/Pages/UserConfirmForm";
import React from "react";
import "./responsivestyle.css";


const App = () => {
    const { carender_elements, auth, user_appointments, userId, flash, permalink } =
        usePage().props;


        const isTablet = window.matchMedia("(min-width: 1024px) and (max-width: 2800px)").matches;
        const isMobile = window.matchMedia("(max-width: 768px)").matches;
      console.log(isMobile);
      console.log(isTablet);
    return (
        <>
            <div className={`${isTablet ? "tablet-layout" : ""}${isMobile ? "mobile-layout" : ""}`}>
            <CalendarTitle carender_elements={carender_elements} />
            <CalendarTable carender_elements={carender_elements}
            ></CalendarTable>
            </div>
            


            {flash.error && (
                <div className="text-center">
                    <div style={{ color: "red" }}>{flash.error}</div>
                </div>
            )}
            {flash.message && (
                <div className="text-center">
                    <div style={{ color: "green" }}>{flash.message}</div>
                </div>
            )}

        

            <UserConfirmForm user_appointments={user_appointments}/>
        </>    
    );
};
export default App;
