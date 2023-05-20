import PrimaryButton from "@/Components/PrimaryButton";
import React from "react";

const CalendarTitle = (props) => {
    const { carender_elements } = props;

    const HundlePrevWeek = () => {
        window.location.href = `?week=${carender_elements.previousWeek}&year=${carender_elements.previousYear}`;
    };

    const HundleNextWeek = () => {
        window.location.href = `?week=${carender_elements.nextWeek}&year=${carender_elements.nextYear}`;
    };

    return (
        <div>
            <div className="flex justify-center items-center py-4">
                <div style={{ paddingRight: "12.75rem" }}>
                    <PrimaryButton onClick={HundlePrevWeek}>先週</PrimaryButton>
                </div>
                <div>
                    <h2>{carender_elements["currentYear"]}年</h2>
                </div>
                <div style={{ paddingLeft: "12.75rem" }}>
                    <PrimaryButton onClick={HundleNextWeek}>次週</PrimaryButton>
                </div>
            </div>
        </div>
    );
};
export default CalendarTitle;
