import { usePage, Head, Link, useForm } from "@inertiajs/react";
import CancelButton from "@/Pages/CancelButton";
import React, { useEffect } from "react";

import dayjs from "dayjs";
import "dayjs/locale/ja";

const AppoDisplay = (props) => {
    const { flash } = usePage().props;

    const { appointments } = props;
    const { userId } = props;
    const user_appointments = appointments.filter((appointment) => {
        return appointment.user_id === userId;
    });
    dayjs.locale("ja");
    const list = () => {
        return user_appointments.map((user_appointment, i) => {
            if (
                user_appointment.date != null &&
                user_appointment.time != null
            ) {
                const display_date = dayjs(user_appointment.date).format(
                    "M月D日 (ddd)"
                );
                return (
                    <li key={i}>
                        <div
                            className="text-center"
                            style={{ display: "flex" }}
                        >
                            <div>
                                {display_date} : {user_appointment.time}
                            </div>
                            <div className="ml-3">
                                {
                                    <CancelButton
                                        date={user_appointment.date}
                                        time={user_appointment.time}
                                        id={user_appointment.id}
                                    ></CancelButton>
                                }
                            </div>
                        </div>
                    </li>
                );
            }
        });
    };

    useEffect(() => {
        // 遅延させたいコードを記述する
        <div
            style={{
                border: "1px solid black",
                borderRadius: "20px",
                padding: "10px",
                margin: "50px 750px",
            }}
        >
            <h1 className="text-center">予約済み一覧</h1>
            {flash.message && (
                <div style={{ color: "green" }}>{flash.message}</div>
            )}
            <ul className="mt-3">{list()}</ul>
        </div>;
    }, []);

    return (
        <div className="mt-5 flex flex-col items-center">
            <div className=" max-w-sm max-auto mt-5 border border-black rounded-xl p-4 m-8 flex flex-col items-center">
                <h1 className="text-center">予約済み一覧</h1>
                {flash.message && (
                    <div style={{ color: "green" }}>{flash.message}</div>
                )}
                <ul className="mt-3">{list()}</ul>
            </div>
        </div>
    );
};
export default AppoDisplay;
