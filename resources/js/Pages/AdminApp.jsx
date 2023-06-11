import { usePage, useForm } from "@inertiajs/react";
import { useState } from "react";
import CalendarTitle from "@/Pages/CalendarTitle";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import AdminCalendar from "@/Pages/AdminCalendar";
import PrimaryButton from "@/Components/PrimaryButton";
import { TiTick, TiTimes } from "react-icons/ti";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";
import React from "react";
import "./responsivestyle.css";

const AdminApp = () => {
    const { carender_elements, calendarLink, auth } = usePage().props;
    const { post } = useForm();

    const isTablet = window.matchMedia(
        "(min-width: 750px) and (max-width: 2800px)"
    ).matches;
    const isMobile = window.matchMedia("(max-width: 749px)").matches;

    const [isCopied, setIsCopied] = useState(false);

    const handleCopy = () => {
        navigator.clipboard
            .writeText(calendarLink)
            .then(() => {
                setIsCopied(true);
            })
            .catch((error) => {
                console.error("コピーできませんでした:", error);
            });
    };

    function submit(e) {
        e.preventDefault();
        post(route("admin.inertiaReset"));
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <div
                className={`${isTablet ? "tablet-layout" : ""}${
                    isMobile ? "mobile-layout" : ""
                }`}
            >
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
                                textDecoration: "underline",
                            }}
                        >
                            カレンダーの設定を変更する
                        </PrimaryButton>
                        <p className="mt-5 mb-2">
                            以下のリンクをユーザに教えてください
                        </p>

                        <p
                            style={{
                                textDecoration: "underline",
                            }}
                        >
                            <a
                                href={calendarLink}
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {calendarLink}
                            </a>
                            <span
                                style={{
                                    textDecoration: "underline",
                                    cursor: "pointer",
                                    marginLeft: "1rem",
                                }}
                                onClick={handleCopy}
                            >
                                {isCopied ? (
                                    <>
                                        <CheckCircleIcon className="copysuccess-icon" />
                                        <span className="copysuccess-text">
                                            コピーしました
                                        </span>
                                    </>
                                ) : (
                                    <span>コピーする</span>
                                )}
                            </span>
                        </p>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};
export default AdminApp;
