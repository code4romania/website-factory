import * as echarts from 'echarts/core';
import { TreemapChart } from 'echarts/charts';
import { CanvasRenderer } from 'echarts/renderers';

import { TitleComponent, TooltipComponent } from 'echarts/components';

echarts.use([TitleComponent, TooltipComponent, TreemapChart, CanvasRenderer]);

export default function (el, { expression }, { evaluate }) {
    const chart = echarts.init(el);

    chart.setOption({
        series: [
            {
                type: 'treemap',
                left: 'left',
                top: 'top',
                right: 0,
                bottom: 50,
                leafDepth: 2,
                levels: [
                    {
                        itemStyle: {
                            borderColor: '#555',
                            borderWidth: 4,
                            gapWidth: 4,
                        },
                    },
                    {
                        colorSaturation: [0.3, 0.6],
                        itemStyle: {
                            borderColorSaturation: 0.7,
                            gapWidth: 2,
                            borderWidth: 2,
                        },
                    },
                    {
                        colorSaturation: [0.3, 0.5],
                        itemStyle: {
                            borderColorSaturation: 0.6,
                            gapWidth: 1,
                        },
                    },
                    {
                        colorSaturation: [0.3, 0.5],
                    },
                ],
                animation: false,
                visibleMin: 300,
                data: evaluate(expression),
            },
        ],
    });

    window.addEventListener('resize', chart.resize);

    return chart;
}
