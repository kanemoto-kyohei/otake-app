import React, { useState } from "react";
import { usePage } from "@inertiajs/react";
import AppoDisplay from "@/Pages/AppoDisplay";
import AppoConfirmForm from "@/Pages/AppoConfirmForm";
import PrimaryButton from "@/Components/PrimaryButton";

const UserConfirmForm = () => {
    const [showForm, setshowForm] = useState(false);

    const handleClick = () => {
        setshowForm(true);
    };
    return (
        <>
            <div className="flex flex-col items-center">
                {!showForm && (
                    <PrimaryButton className="mt-5" onClick={handleClick}>
                        予約を確認する
                    </PrimaryButton>
                )}
                {showForm && (
                    <div className="mt-5">
                        <AppoConfirmForm />
                    </div>
                )}
            </div>
        </>
    );
};

export default UserConfirmForm;
