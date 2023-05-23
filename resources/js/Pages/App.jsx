import { usePage } from "@inertiajs/react";
import CalendarTitle from "@/Pages/CalendarTitle";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import CalendarTable from "@/Pages/CalendarTable";
import AppoDisplay from "@/Pages/AppoDisplay";
import { useMediaQuery } from "react-responsive";
import React from "react";


const App = () => {
    const { carender_elements, auth, appointments, userId, flash } =
        usePage().props;
    const isDesktop = useMediaQuery({ minWidth: 1025 });
    const isTablet = useMediaQuery({ minWidth: 769, maxWidth: 1024 });
    const isMobile = useMediaQuery({ maxWidth: 768 });

    return (
    
        <AuthenticatedLayout user={auth.user}>
            {isDesktop && (
            <>
            <CalendarTitle carender_elements={carender_elements} />
            <CalendarTable carender_elements={carender_elements}
            ></CalendarTable>
            </>
            ) }

            {isTablet && (
            <div style={{ maxWidth: '768px', margin: '0 auto' }}>
            <CalendarTitle carender_elements={carender_elements} />
            <CalendarTable carender_elements={carender_elements}
            ></CalendarTable>
            </div>
            ) }

            {isMobile && (
            <div style={{ maxWidth: '480px', margin: '0 auto' }}>
            <CalendarTitle carender_elements={carender_elements} />
            <CalendarTable carender_elements={carender_elements}
            ></CalendarTable>
            </div>
            ) }

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
